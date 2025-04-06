import React, { useState } from "react";

const PostProduct: React.FC = () => {
  const [name, setName] = useState("");
  const [description, setDescription] = useState("");
  const [price, setPrice] = useState("");
  const [image, setImage] = useState<File | null>(null);
  const [message, setMessage] = useState("");

  const user = JSON.parse(localStorage.getItem("user") ?? "{}");

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    if (!user?.id) return;

    const formData = new FormData();
    formData.append("user_id", user.id.toString());
    formData.append("name", name);
    formData.append("description", description);
    formData.append("price", price);
    if (image) formData.append("image", image);

    try {
      const res = await fetch("http://localhost:8000/create_product.php", {
        method: "POST",
        body: formData,
      });
      const data = await res.json();

      if (data.success) {
        setMessage("Product posted successfully!");
        setName("");
        setDescription("");
        setPrice("");
        setImage(null);
      } else {
        setMessage("Failed to post product.");
      }
    } catch (err) {
      setMessage("Error submitting product.");
    }
  };

  return (
    <div className="container mt-4" style={{ maxWidth: 600 }}>
      <h2>Post a New Product</h2>
      {message && <div className="alert alert-info">{message}</div>}
      <form onSubmit={handleSubmit} encType="multipart/form-data">
        <div className="mb-3">
          <label className="form-label">Product Name</label>
          <input
            className="form-control"
            value={name}
            onChange={(e) => setName(e.target.value)}
            required
          />
        </div>
        <div className="mb-3">
          <label className="form-label">Description</label>
          <textarea
            className="form-control"
            value={description}
            onChange={(e) => setDescription(e.target.value)}
            required
          />
        </div>
        <div className="mb-3">
          <label className="form-label">Price (KES)</label>
          <input
            type="number"
            className="form-control"
            value={price}
            onChange={(e) => setPrice(e.target.value)}
            required
          />
        </div>
        <div className="mb-3">
          <label className="form-label">Product Image</label>
          <input
            type="file"
            className="form-control"
            onChange={(e) => setImage(e.target.files?.[0] || null)}
          />
        </div>
        <button className="btn btn-primary w-100">Post Product</button>
      </form>
    </div>
  );
};

export default PostProduct;
