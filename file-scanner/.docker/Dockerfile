FROM golang:1.20

# Set the working directory in the container
WORKDIR /app

# Copy the local package files to the container
COPY ./ .

# Install Tesseract and any additional dependencies
RUN apt-get update && apt-get install -y tesseract-ocr libtesseract-dev

RUN go mod init file-scanner
RUN go get -u github.com/nfnt/resize
RUN go get -u github.com/anthonynsimon/bild
RUN go get -u github.com/minio/minio-go/v7
RUN go get -u github.com/otiai10/gosseract/v2
RUN go get go.temporal.io/sdk/activity
RUN go get go.temporal.io/sdk/client
RUN go get go.temporal.io/sdk/worker

RUN cd cmd && go build -buildvcs=false && cp cmd /usr/local/bin/file-scanner

# Run the application when the container starts
CMD ["file-scanner"]
