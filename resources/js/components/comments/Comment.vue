<template>

    <div class="mt-3">

        <div class="card rounded-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <p class="fw-bold">{{ username }}</p>
                    </div>
                    <div class="col-12">
                        <p>{{ content }}</p>
                    </div>
                    <div class="col-12">
                        <a class="link" @click="changeReplyVisibility">
                            <div v-if="!isReplyHidden">
                                Reply
                            </div>
                            <div v-else>
                                Cancel
                            </div>
                        </a>
                        <new-comment v-if="isReplyHidden" :id="id"></new-comment>
                    </div>
                </div>
            </div>
        </div>

        <div class="ms-3">
            <slot></slot>
        </div>

    </div>

</template>

<script>
import { ref } from 'vue'
import NewComment from './NewComment'

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
        id: {
            required: true,
            type: Number
        }
    },
    setup(props) {
        let isReplyHidden = ref(false)

        const changeReplyVisibility = () => {
            isReplyHidden.value = !isReplyHidden.value
            console.log(isReplyHidden.value)
        }

        return {
            changeReplyVisibility,
            isReplyHidden,
            username: props.username,
            content: props.content,
        }
    },
    components: {
        NewComment
    }
}
</script>

        NewComment
