from ultralytics import YOLO

# Load YOLOv8 model (use yolov8n.pt, yolov8s.pt, etc.)
model = YOLO("yolov8n.pt")

# Train the model
model.train(
    data="dataset.yaml",  # Path to your dataset configuration
    epochs=50,            # Number of training epochs
    imgsz=640             # Image size
)

print("Training complete. Best weights saved as best.pt")