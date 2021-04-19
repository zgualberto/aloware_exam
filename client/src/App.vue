<template>
    <v-app>
        <Posts />
    </v-app>
</template>

<script>
import Posts from "@/components/Posts";

export default {
    name: "App",

    data: () => ({
        //
    }),
    components: {
        Posts,
    },
};
</script>
