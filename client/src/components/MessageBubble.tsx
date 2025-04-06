import React from "react";

interface Props {
  text: string;
  sentByCurrentUser: boolean;
}

const MessageBubble: React.FC<Props> = ({ text, sentByCurrentUser }) => {
  return (
    <div
      className={`mb-2 p-2 rounded ${
        sentByCurrentUser
          ? "bg-primary text-white text-end"
          : "bg-light text-start"
      }`}
    >
      {text}
    </div>
  );
};

export default MessageBubble;
