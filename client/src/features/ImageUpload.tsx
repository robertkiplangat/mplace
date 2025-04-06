import React, { useState } from "react";

const ImageUpload: React.FC = () => {
  const [selectedImage, setSelectedImage] = useState<File | null>(null);
  const [uploadMsg, setUploadMsg] = useState("");

  const handleImageChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    if (e.target.files) {
      setSelectedImage(e.target.files[0]);
    }
  };

  const handleUpload = async () => {
    if (!selectedImage) {
      setUploadMsg("Please select an image first.");
      return;
    }

    const formData = new FormData();
    formData.append("image", selectedImage);

    try {
      const response = await fetch("http://localhost:8000/upload_image.php", {
        method: "POST",
        body: formData,
      });

      const data = await response.json();
      setUploadMsg(data.message || "Image uploaded successfully!");
    } catch (error) {
      setUploadMsg("Error uploading the image. Please try again.");
    }
  };

  return (
    <div className="container">
      <h2>Upload Product Image</h2>
      {uploadMsg && <div className="alert alert-info">{uploadMsg}</div>}
      <input
        type="file"
        className="form-control mb-3"
        onChange={handleImageChange}
      />
      <button className="btn btn-primary" onClick={handleUpload}>
        Upload Image
      </button>
    </div>
  );
};

export default ImageUpload;
