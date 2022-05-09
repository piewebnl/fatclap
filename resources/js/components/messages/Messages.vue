<template>
  <div v-if="messages && showMessage" class="block">
    <div v-if="messages.isArray">
      <div
        v-for="message in messages"
        role="alert"
        v-if="message"
        :class="setClass(message)"
      >
        {{ message.text }}
      </div>
    </div>
    <div v-else>
      <div v-if="messages" :class="setClass(messages)">
        {{ messages.text }}
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      showMessage: true,
    };
  },

  computed: {
    messages: {
      get() {
        return this.$store.state.messages;
      },
      set(value) {
        this.$store.commit("updateMessages", value);
      },
    },
  },

  watch: {
    messages(newValue, oldValue) {
      if (newValue != oldValue) {
        this.showMessage = true;
        self = this;
        setTimeout(function () {
          self.showMessage = false;
        }, 5000);
      }
    },
  },

  methods: {
    // success, danger, warning, infonp
    setClass(message) {
      if (!message.text) return;
      let color = "gray"; // default
      if (message.status == "success") {
        color = "green";
      }
      if (message.status == "danger") {
        color = "orange";
      }
      if (message.status == "warning" || message.status == "error") {
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
