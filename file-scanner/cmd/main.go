package main

import (
	"fmt"
	"github.com/otiai10/gosseract"
)

func main() {
	// Create a new gosseract client
	client := gosseract.NewClient()
	defer client.Close()

	// Set the path to the check image
	imagePath := "images/check.png"

	// Set the language for OCR (e.g., "eng" for English)
	client.SetLanguage("eng")

	// Open the image file
	err := client.SetImage(imagePath)
	if err != nil {
		fmt.Println("Error setting image:", err)
		return
	}

	// Perform OCR on the image
	text, err := client.Text()
	if err != nil {
		fmt.Println("Error extracting text:", err)
		return
	}

	// Print the extracted text
	fmt.Println("Scanned text:")
	fmt.Println(text)
}
