import React from "react";
import ReactDOM from "react-dom";

import Post from "./posts/Post";

const App = () => {
    return (
        <>
            <h1 className="text-center">Example</h1>
            <Post />
        </>
    );
};

export default App;

if (document.getElementById("app")) {
    ReactDOM.render(<App />, document.getElementById("app"));
}
