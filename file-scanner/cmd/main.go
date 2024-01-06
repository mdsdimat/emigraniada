package main

import (
	"context"
	"fmt"
	"log"
	"os"
	"strings"

	"github.com/minio/minio-go/v7"
	"github.com/minio/minio-go/v7/pkg/credentials"
	"github.com/otiai10/gosseract/v2"
	"go.temporal.io/sdk/activity"
    "go.temporal.io/sdk/client"
    "go.temporal.io/sdk/worker"
)

func main() {
    if err != nil {
        log.Fatalln("Unable to create Temporal Client", err)
    }
    defer temporalClient.Close()

    temporalClient, err := client.Dial(client.Options{
        HostPort: os.Getenv("TEMPORAL_ADDRESS"),
    })

    if err != nil {
        log.Fatalln("Unable to create client", err)
    }
    defer temporalClient.Close()

    w := worker.New(temporalClient, "scanner", worker.Options{})

    w.RegisterActivityWithOptions(
        fileToText,
        activity.RegisterOptions{Name: "scanner.FileToText"},
    )

    err = w.Run(worker.InterruptCh())
    if err != nil {
        log.Fatalln("Unable to start worker", err)
    }
}

func fileToText(objectName string) (string, error) {
	endpoint := os.Getenv("MINIO_ENDPOINT")
	accessKeyID := os.Getenv("AWS_KEY")
	secretAccessKey := os.Getenv("AWS_SECRET")
	useSSL := false // Change to true if your MinIO server uses SSL

	minioClient, err := minio.New(endpoint, &minio.Options{
		Creds:  credentials.NewStaticV4(accessKeyID, secretAccessKey, ""),
		Secure: useSSL,
	})
	if err != nil {
		log.Fatalln(err)
	}

	// MinIO bucket and object parameters
	bucketName := os.Getenv("AWS_BUCKET")

	localFilePath := "/tmp/check_image.png"

	err = downloadFile(minioClient, bucketName, objectName, localFilePath)
	if err != nil {
		log.Fatalln(err)
	}

	scannedText, err := performOCR(localFilePath)
    if err != nil {
        log.Fatalln(err)
    }

    // Print the extracted text in the main function
    fmt.Println("Scanned text:")
    fmt.Println(scannedText)

    return scannedText, nil
}

func downloadFile(client *minio.Client, bucket, object, filePath string) error {
	ctx := context.Background()

	_, err := client.StatObject(ctx, bucket, object, minio.StatObjectOptions{})
	if err != nil {
		return fmt.Errorf("File not found on MinIO: %v", err)
	}

	err = client.FGetObject(ctx, bucket, object, filePath, minio.GetObjectOptions{})
	if err != nil {
		return fmt.Errorf("Error downloading file from MinIO: %v", err)
	}

	fmt.Printf("File downloaded to %s\n", filePath)
	return nil
}

func performOCR(imagePath string) (string, error) {
	client := gosseract.NewClient()
	defer client.Close()

	client.SetImage(imagePath)

	client.SetLanguage("eng")

	text, err := client.Text()
	if err != nil {
		return "", fmt.Errorf("Error extracting text: %v", err)
	}

	singleLineText := strings.Join(strings.Fields(text), " ")
	return singleLineText, nil
}
