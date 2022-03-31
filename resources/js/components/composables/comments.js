import { ref } from 'vue'
import axios from 'axios'

export default function useComments() {

    const comments = ref([])
    const newComment = ref([])
    const loading = ref(true)

    const getComments = async () => {
        try {
            const response = await axios.get('http://localhost:8000/api/v1/comments', {
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            });
            comments.value = response.data
            console.log(typeof comments.value)

            return comments
        } catch (error) {
            console.log(error)
            return error;
        }
    }

    const storeComment = async(data) => {
        try {
            const response = await axios.post('http://localhost:8000/api/v1/comments', data, {
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            });

            newComment.value = response.data.data
            // console.log(newComment.value)
            comments.value.push({
                username: newComment.value.username,
                content: newComment.value.content
            })
            console.log('comments', comments)
            return newComment
        } catch (error) {
            return error
        }
    }

    return {
        newComment,
        comments,
        getComments,
        storeComment,
        loading
    }

}
