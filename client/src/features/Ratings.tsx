import React, { useState } from "react";

interface Props {
  productId: number;
}

const Ratings: React.FC<Props> = ({ productId }) => {
  const [rating, setRating] = useState(0);
  const [message, setMessage] = useState("");
  const [currentRating, setCurrentRating] = useState<number | null>(null);
  const [isSubmitting, setIsSubmitting] = useState(false);

  const handleRatingChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    setRating(Number(e.target.value));
  };

  const submitRating = async () => {
    if (isSubmitting) return; // Prevent multiple submissions

    setIsSubmitting(true);
    const response = await fetch("http://localhost:8000/submit_rating.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ productId, rating }),
    });

    const data = await response.json();
    setMessage(data.message || "Rating submitted!");
    if (data.message === "Rating submitted successfully") {
      setCurrentRating(rating); // Update the displayed rating
    }
    setIsSubmitting(false);
  };

  return (
    <div className="container">
      <h3>Rate this Product</h3>
      {message && <div className="alert alert-info">{message}</div>}
      <div className="mb-3">
        <label>Rating: </label>
        <input
          type="number"
          min="1"
          max="5"
          className="form-control w-25"
          value={rating}
          onChange={handleRatingChange}
        />
      </div>
      <button
        className="btn btn-primary"
        onClick={submitRating}
        disabled={isSubmitting}
      >
        {isSubmitting ? "Submitting..." : "Submit Rating"}
      </button>
      {currentRating && <p>Your Rating: {currentRating}</p>}
    </div>
  );
};

export default Ratings;
