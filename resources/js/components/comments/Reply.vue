<template>

    <div>

        <div class="card rounded-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <p class="fw-bold">{{ username }}</p>
                    </div>
                    <div class="col-12">
                        <p>{{ content }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div v-if="hasReplies">
            <div class="ms-3">
                <div v-for="reply in replies" :key="reply.id">
                    <reply-comment
                        :username="reply.username"
                        :content="reply.content"
                        :replies="reply.replies"
                    />
                </div>
            </div>
        </div>




    </div>

</template>

<script>
import Comment from './Comment.vue'

export default {
    props: {
        username: {
            required: true,
            type: String
        },
        content: {
            required: true,
            type: String
        },
        replies: {
            required: false,
            type: Array
        },
    },
    setup(props) {
        var hasReplies = false
        if(props.replies.length > 0) {
            hasReplies = true
        }

        return {
            hasReplies,
            replies: props.replies,
            username: props.username,
            content: props.content
        }
    },
    components: {
        Comment
    }
}
</script>
