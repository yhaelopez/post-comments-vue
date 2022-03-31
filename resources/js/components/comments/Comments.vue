<template>

    <new-comment></new-comment>

    <h1>Comments</h1>
    <div v-if="loading">
        <p>loading...</p>
    </div>
    <div v-else>
        <div v-for="comment in comments.data" :key="comment.id">
            <comment
                :username="comment.attributes.username"
                :content="comment.attributes.content"
                :id="comment.attributes.id"
                @load="loading.value = true; getComments().then(res => {
                    loading.value = false
                })"
            >
                <div v-if="comment.attributes.replies.data.length > 0">
                    <comment
                        v-for="secondComment in comment.attributes.replies.data"
                        :key="secondComment.attributes.id"
                        :username="secondComment.attributes.username"
                        :content="secondComment.attributes.content"
                        :id="secondComment.attributes.id"
                    >
                        <div v-if="secondComment.attributes.replies.data.length > 0">
                            <comment
                                v-for="thirdComment in secondComment.attributes.replies.data"
                                :key="thirdComment.attributes.id"
                                :username="thirdComment.attributes.username"
                                :content="thirdComment.attributes.content"
                                :id="thirdComment.attributes.id"
                            />

                        </div>

                    </comment>

                </div>
            </comment>
        </div>

    </div>
</template>

<script>
import { onMounted } from 'vue'
import useComments from '../composables/comments'
import Comment from '../comments/Comment'
import NewComment from './NewComment'

export default {
    setup() {

        const { comments, getComments, loading }= useComments()

        onMounted(getComments().then(res => {
            loading.value = false
        }))

        return {
            loading,
            comments,
            getComments
        }

    },
    components: {
        NewComment,
        Comment
    }
}
</script>

<style>

</style>
