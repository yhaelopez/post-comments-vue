import React from "react";
import PropTypes from "prop-types";
import Comment from "./Comment";

const Comments = (props) => {
    const { loading, setLoading } = props;
    return (
        <>
            <div>
                {props.comments.map((comment, idx) => {
                    return (
                        <div id={idx} key={idx}>
                            <Comment setLoading={setLoading} loading={loading} comment={comment} />
                            {comment.attributes.replies.data?.map(
                                (reply, idx2) => {
                                    console.log("i", idx2);

                                    return (
                                        <div className="ms-3" key={idx2}>
                                            <Comment setLoading={setLoading} loading={loading} comment={reply} />
                                            {reply.attributes.replies.data?.map(
                                                (subreply, idx3) => {
                                                    return (
                                                        <div
                                                            key={idx3}
                                                            className="ms-3"
                                                        >
                                                            <Comment
                                                                setLoading={setLoading} loading={loading}
                                                                comment={
                                                                    subreply
                                                                }
                                                            />
                                                        </div>
                                                    );
                                                }
                                            )}
                                        </div>
                                    );
                                }
                            )}
                        </div>
                    );
                })}
            </div>
        </>
    );
};

Comments.propTypes = {
    comments: PropTypes.array.isRequired,
};

export default Comments;
