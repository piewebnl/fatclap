<template>
  <div class="image">
    <img
      :src="'/storage/images/meals/' + image.name + '-medium.jpg'"
      :alt="name"
      :style="'height: ' + height"
      class="w-full object-cover"
    />
  </div>
</template>

<script>
export default {
  props: {
    image: {
      type: Object,
      required: true,
      default: "",
    },
    name: {
      type: String,
      required: false,
      default: "",
    },

    height: {
      type: String,
      default: "200px",
    },
  },
};
</script>
