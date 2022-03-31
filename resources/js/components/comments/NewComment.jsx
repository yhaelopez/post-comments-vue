import axios from "axios";
import React, { useState } from "react";

const NewComment = (props) => {
    const [username, setUsername] = useState("");
    const [content, setContent] = useState("");
    const { setLoading, loading, parentId, setIsOpen } = props;
    const [error, setError] = useState(false);

    const handleSubmit = async (postId = 1) => {
        try {
            if (error) {
                setError(false);
            }
            if (!username || !content) {
                setError(true);
                return;
            }
            let headers = {
                Accept: "application/json",
                "Content-Type": "application/json",
            };
            let data = {
                username,
                content,
                post_id: postId,
            };
            if (parentId) {
                data.parent_id = parentId;
            }
            const response = await axios.post(
                "http://localhost:8000/api/v1/comments",
                data,
                { headers }
            );
            console.log(response.data.data);
            if (setIsOpen) {
                setIsOpen(false);
            }

            setLoading(!loading);
        } catch (error) {
            console.log(error);
        }
    };

    return (
        <>
            {error && (
                <div className="alert alert-danger" role="alert">
                    Both fields must be filled to be able to comment
                </div>
            )}
            <input
                className="form-control mb-2 bg-white"
                placeholder="Username"
                type="text"
                onChange={(e) => setUsername(e.target.value)}
            />
            <textarea
                className="form-control my-2 bg-white"
                placeholder="What do yu think about this post? Leave your comments..."
                rows="3"
                onChange={(e) => setContent(e.target.value)}
            ></textarea>
            <button
                className="btn btn-primary btn-lg"
                onClick={() => handleSubmit()}
            >
                Submit
            </button>
        </>
    );
};

export default NewComment;
