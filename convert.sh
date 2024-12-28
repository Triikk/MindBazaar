#!/bin/bash

# Directory containing the images
input_directory="upload/products/nozioni"

# Function to convert images to .png
convert_images_to_jpg() {
    find "$input_directory" -type f \( -iname "*.jpg" -o -iname "*.jpeg" -o -iname "*.bmp" -o -iname "*.gif" -o -iname "*.tiff" -o -iname "*.avif" -o -iname "*.webp" \) | while read file; do
        new_file="${file%.*}.png"
        convert "$file" "$new_file"
        echo "Converted $file to $new_file"
    done
}

# Convert images
convert_images_to_jpg

rm -f upload/products/{emozioni,sogni,ispirazioni,nozioni}/*.{webp,jpeg,jpg,avif}