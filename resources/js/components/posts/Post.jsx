import axios from "axios";
import React, { useState, useEffect } from "react";
import Comments from "../comments/Comments";
import NewComment from "../comments/NewComment";

const Post = () => {
    const [comments, setComments] = useState([]);
    const [loading, setLoading] = useState(false);

    useEffect(async () => {
        try {
            let headers = {
                Accept: "application/json",
                "Content-Type": "application/json",
            };
            const response = await axios.get(
                "http://localhost:8000/api/v1/comments",
                { headers }
            );
            setComments(Object.values(response.data.data));
        } catch (error) {
            console.log(error);
        }
    }, [loading]);

    return (
        <>
            <h1 className="text-center">Post</h1>
            <h2>Comments</h2>
            <NewComment setLoading={setLoading} loading={loading} />
            {comments && (
                <Comments
                    setLoading={setLoading}
                    loading={loading}
                    comments={comments}
                />
            )}
        </>
    );
};

export default Post;
