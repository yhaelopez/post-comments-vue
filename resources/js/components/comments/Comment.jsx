import React, { useState } from "react";
import PropTypes from "prop-types";
import NewComment from "./NewComment";

const Comment = (props) => {
    const { loading, setLoading, comment } = props;
    const [isOpen, setIsOpen] = useState(false);

    return (
        <>
            <div className="mt-3">
                <div className="card rounded-3 shadow-sm">
                    <div className="card-body">
                        <div className="row">
                            <div className="col-12">
                                <p className="h4 fw-bold">
                                    {comment.attributes.username}
                                </p>
                            </div>
                            <div className="col-12">
                                <p>{comment.attributes.content}</p>
                            </div>
                            <div className="col-12">
                                <a
                                    className="link"
                                    onClick={() => setIsOpen(!isOpen)}
                                >
                                    {!isOpen ? "Reply" : "Cancel"}
                                </a>
                                <div className="mt-4">
                                    {isOpen && (
                                        <NewComment
                                            setIsOpen={setIsOpen}
                                            parentId={comment.attributes.id}
                                            setLoading={setLoading}
                                            loading={loading}
                                        />
                                    )}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </>
    );
};

Comment.propTypes = {
    comment: PropTypes.object.isRequired,
};

export default Comment;
