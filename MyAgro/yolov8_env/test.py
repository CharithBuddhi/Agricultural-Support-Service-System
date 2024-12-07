import sys

# Get the image path from PHP
image_path = sys.argv[1]

# Print a simple message to verify
try:
    print(f"Received image path: {image_path}")
except Exception as e:
    print("Error:")

# result = "banana"
# print(result)