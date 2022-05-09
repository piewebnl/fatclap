<template>
  <router-link :class="setClass(type)" :to="to">
    <ion-icon :name="ionIcon" v-if="ionIcon"></ion-icon>
    <span v-if="title">{{ title }}</span>
  </router-link>
</template>

<script>
export default {
  props: {
    title: {
      type: String,
    },
    ionIcon: {
      type: String,
    },
    type: {
      type: String,
    },
    to: {
      type: Object,
    },
  },
  methods: {
    setClass(type) {
      let color = "text-lg btn gray"; // default
      if (type == "save") {
        color = "green";
      }
      if (type == "delete") {
        color = "red";
      }
      return (
        "rounded-xl border text-" +
        color +
        "-600 border-" +
        color +
        "-600 my-4 p-4 bg-" +
        color +
        "-100"
      );
    },
  },
};
</script>
