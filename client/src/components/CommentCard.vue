<template>
    <v-card elevation="0">
        <v-card-text class="pa-0">
            <div class="d-flex justify-start mb-4">
                <div class="avatar pt-3">
                    <v-avatar color="primary" size="36">
                        <span class="white--text headline">
                            {{ post.username.charAt(0).toUpperCase() }}
                        </span>
                    </v-avatar>
                </div>
                <div class="comment-wrapper ml-3">
                    <v-card outlined class="pa-3 w-100">
                        <v-card-text class="pa-0">
                            <span>
                                <strong>{{ post.username }}</strong>
                                <span class="px-1">•</span>
                                {{ getMoment(post.created_at) }}
                            </span>
                            <p class="mt-1 mb-0">{{ post.comment }}</p>
                        </v-card-text>
                    </v-card>
                    <v-btn
                        v-if="
                            undefined !== post.reply ||
                            undefined !== post.sub_reply
                        "
                        class="ma-1"
                        text
                        small
                        @click="createReply(post)"
                        >Reply</v-btn
                    >
                    <div v-if="showReplyForm">
                        <v-text-field
                            outlined
                            label="Name"
                            v-model="newPost.username"
                        ></v-text-field>
                        <v-textarea
                            label="Post"
                            auto-grow
                            outlined
                            v-model="newPost.comment"
                        ></v-textarea>
                        <v-btn
                            class="ma-1"
                            @click="sendReply(post)"
                            color="primary"
                            >Send</v-btn
                        >
                    </div>
                    <div
                        v-if="undefined !== post.reply && post.reply.length > 0"
                    >
                        <ComponentCard
                            v-for="replyPost in post.reply"
                            :key="replyPost.id"
                            :post="replyPost"
                            :newPost="newPost"
                            :savenewpostreply="savenewpostreply"
                        />
                    </div>
                    <div
                        v-if="
                            undefined !== post.sub_reply &&
                            post.sub_reply.length > 0
                        "
                    >
                        <ComponentCard
                            v-for="subReplyPost in post.sub_reply"
                            :key="subReplyPost.id"
                            :post="subReplyPost"
                            :newPost="newPost"
                            :savenewpostreply="savenewpostreply"
                        />
                    </div>
                </div>
            </div>
        </v-card-text>
    </v-card>
</template>

<script>
import moment from "moment";
import ComponentCard from "@/components/CommentCard";

export default {
    name: "ComponentCard",
    components: {
        ComponentCard,
    },
    props: {
        post: {
            required: true,
            type: Object,
        },
        newPost: {
            required: false,
            type: Object,
            default: () => {},
        },
        overlay: {
            required: false,
            type: Boolean,
            default: false,
        },
        savenewpostreply: { type: Function },
    },
    data() {
        return {
            showReplyForm: false,
        };
    },
    methods: {
        getMoment(date) {
            return moment(date, "YYYY-MM-DD hh:mm:ss").fromNow();
        },
        createReply() {
            this.showReplyForm = !this.showReplyForm;
        },
        sendReply(post) {
            let data;
            if (
                null === this.newPost.username ||
                null === this.newPost.comment
            ) {
                alert("Missing fields");
                return false;
            }

            if (post.parent_post_id == null && post.parent_reply_id == null) {
                data = {
                    username: this.newPost.username,
                    comment: this.newPost.comment,
                    parent_post_id: post.id,
                };
            } else {
                data = {
                    username: this.newPost.username,
                    comment: this.newPost.comment,
                    parent_reply_id: post.id,
                };
            }

            console.log(data);

            this.savenewpostreply(data);
            this.showReplyForm = false;
            this.newPost.comment = null;
        },
    },
};
</script>

<style lang="scss" scoped>
.comment-wrapper {
    width: 100%;
    .avatar {
        float: left !important;
    }
    .comment-body {
        float: left !important;
    }
}

.styled-input {
    height: 10px;
    font-size: 8px;
}
</style>
