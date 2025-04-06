import React, { useState } from "react";

const ProductForm: React.FC<{ onSubmit: (data: FormData) => void }> = ({
  onSubmit,
}) => {
  const [name, setName] = useState("");
  const [desc, setDesc] = useState("");
  const [price, setPrice] = useState("");
  const [image, setImage] = useState<File | null>(null);

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();

    const formData = new FormData();
    formData.append("name", name);
    formData.append("description", desc);
    formData.append("price", price);
    if (image) formData.append("image", image);

    onSubmit(formData); // The parent component should handle this function
  };

  return (
    <form onSubmit={handleSubmit} encType="multipart/form-data">
      <input
        className="form-control mb-2"
        placeholder="Name"
        value={name}
        onChange={(e) => setName(e.target.value)}
        required
      />
      <textarea
        className="form-control mb-2"
        placeholder="Description"
        value={desc}
        onChange={(e) => setDesc(e.target.value)}
        required
      />
      <input
        className="form-control mb-2"
        type="number"
        placeholder="Price (KES)"
        value={price}
        onChange={(e) => setPrice(e.target.value)}
        required
      />
      <input
        className="form-control mb-3"
        type="file"
        onChange={(e) => setImage(e.target.files?.[0] || null)}
      />
      <button className="btn btn-success w-100">Submit</button>
    </form>
  );
};

export default ProductForm;
