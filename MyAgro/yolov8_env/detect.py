import sys
from ultralytics import YOLO
import os

# Get the image path from PHP
image_name = sys.argv[1]

# terminal always get the current directory location.so it need to change with python code exist location
# current directory is D:/a XAmpp projec/htdocs/Agricultural-Support-Service-System/MyAgro/end
# change directory to D:/a XAmpp projec/htdocs/Agricultural-Support-Service-System/MyAgro/yolov8_env
# Path to the model file
model_path = "D:/a XAmpp projec/htdocs/Agricultural-Support-Service-System/MyAgro/yolov8_env/best.pt"

# Check if the model file exists
if not os.path.exists(model_path):
    print(f"Error: Model file not found at {model_path}")
    sys.exit(1)

# Load the trained model
try:
    model = YOLO(model_path)
    print("Model loaded successfully!")
except Exception as e:
    print(f"Error loading model: {e}")
    sys.exit(1)

# Continue with your script...


# Set the absolute path to the try_data folder
try_data_path = os.path.join(
    "D:\\a XAmpp projec\\htdocs\\Agricultural-Support-Service-System\\MyAgro\\yolov8_env", 
    "try_data"
)

# Construct the full image path
image_path = os.path.join(try_data_path, image_name)
print(f"Image path: {image_path}")

# Check if the file exists
if not os.path.exists(image_path):
    print(f"Error: File not found at {image_path}")
    sys.exit(1)

# Perform inference on the image with a confidence threshold of 75%
try:
    print(f"Running inference on image: {image_path}")
    results = model(image_path, conf=0.75)
    print("Inference completed successfully.")
except Exception as e:
    print(f"Error during inference: {e}")
    sys.exit(1)

# Extract the first detected object's class name
first_class_name = None  # Initialize variable

# Uncomment the detection extraction logic if needed
for result in results:
    if result.boxes.data.shape[0] > 0:  # Check if any detections exist
        first_box = result.boxes.data[0]  # Get the first detection
        first_class_id = int(first_box[5])  # Extract the class ID
        first_class_name = result.names[first_class_id]  # Get the class name
        break

# Print the first class name
if first_class_name:
    print(first_class_name)
else:
    print(f"Please provide a clear image.")
