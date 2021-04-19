<template>
  <div class="clearfix">
    <v-container class="pa-3">
      <h1>Posts</h1>
      <div v-if="posts.length > 0">
        <CommentCard
          v-for="post in posts"
          :key="post.id"
          :post="post"
          :newPost="newPost"
          :savenewpostreply="saveNewPost"
        />
      </div>
    </v-container>
    <!-- START OF OVERLAY -->
    <v-overlay :value="overlay">
      <v-progress-circular indeterminate size="64"></v-progress-circular>
    </v-overlay>
    <!-- ENF OF OVERLAY -->
    <!-- START OF NEW POST DIALOG -->
    <v-dialog
      transition="dialog-bottom-transition"
      max-width="600"
      v-model="newPostDialog"
    >
      <template v-slot:activator="{ on, attrs, checkUsername }">
        <v-btn
          fab
          fixed
          bottom
          right
          color="primary"
          v-bind="attrs"
          v-on="on"
          @click="checkUsername"
        >
          <v-icon>mdi-plus</v-icon>
        </v-btn>
      </template>
      <template>
        <v-card>
          <v-toolbar color="primary" dark>Create new post</v-toolbar>
          <v-card-text class="pa-3">
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
          </v-card-text>
          <v-card-actions class="justify-end">
            <v-btn text @click="prepareData">Save</v-btn>
            <v-btn text @click="newPostDialog = false">Close</v-btn>
          </v-card-actions>
        </v-card>
      </template>
    </v-dialog>
    <!-- END OF NEW POST DIALOG -->
  </div>
</template>

<script>
import CommentCard from "@/components/CommentCard";
import axios from "axios";

export default {
  components: {
    CommentCard,
  },
  data() {
    return {
      errorMessage: null,
      errorMessageShow: false,
      newPostDialog: false,
      posts: [],
      newPost: {
        username: null,
        comment: null,
        parent_post_id: null,
        parent_repy_id: null,
      },
      overlay: false,
    };
  },
  created() {
    axios.get(`${process.env.VUE_APP_API_URL}/posts`).then(({ data }) => {
      this.posts = data.data;
    });
  },
  methods: {
    prepareData() {
      if (null === this.newPost.username || null === this.newPost.comment) {
        alert("Missing field");
        return false;
      }
      const data = {
        username: this.newPost.username,
        comment: this.newPost.comment,
      };

      this.saveNewPost(data);
    },
    saveNewPost(data) {
      this.overlay = true;
      axios
        .post(`${process.env.VUE_APP_API_URL}/posts`, data)
        .then(({ data }) => {
          this.posts = data.data;
          this.overlay = false;
        })
        .catch(() => {
          this.overlay = false;
        });
      this.newPost.comment = null;
      this.newPostDialog = false;
    },
  },
};
</script>
