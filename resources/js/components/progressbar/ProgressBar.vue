<template>
  <div class="py-2">
    <div class="flex mb-2 items-center justify-between">
      <div class="text-right">
        <span :class="'text-xs inline-block'"> {{ roundedPercentage }}% </span>
      </div>
    </div>
    <div :class="'overflow-hidden h-2 mb-4 text-xs flex rounded bg-white'">
      <div
        :style="'width: ' + roundedPercentage + '%'"
        :class="
          'shadow-none flex flex-col text-center whitespace-nowrap text-' +
          barTextColor +
          ' justify-center bg-' +
          barBgColor +
          ''
        "
      ></div>
    </div>
    <div>
      <span
        :class="
          'text-sm inline-block px-4 py-2 rounded-full text-' +
          textColor +
          ' bg-' +
          bgColor +
          ''
        "
      >
        <span v-if="roundedPercentage < 100">
          {{ textProgress }}
        </span>
        <span v-else>
          {{ textDone }}
        </span>
      </span>
    </div>
  </div>
</template>


<script>
export default {
  props: {
    textProgress: {
      type: String,
      default: "In progress...",
    },
    textDone: {
      type: String,
      default: "Done!",
    },
    percentage: {
      type: Number,
    },
    barBgColor: {
      type: String,
      default: "orange-500",
    },
    barTextColor: {
      type: String,
      default: "white",
    },
    bgColor: {
      type: String,
      default: "white",
    },
    textColor: {
      type: String,
      default: "orange-500",
    },
  },

  computed: {
    roundedPercentage() {
      return Math.round(this.percentage);
    },
  },
};
</script>
