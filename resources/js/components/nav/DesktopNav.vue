<template>
  <div class="w-50 z-10 top-0 h-full bg-white p-4">
    <nav class="flex flex-row wrap whitespace-nowrap">
      <router-link
        v-for="(menuButton, index) in menuButtons"
        v-model="view"
        :key="index"
        class="menu-link"
        :to="{ name: menuButton.name }"
        v-if="allowedToView(menuButton.guest)"
        >{{ menuButton.label }}</router-link
      >

      <div class="p-4"></div>

      <div v-if="!userLoggedIn">
        <a href="/login" class="menu-link">Login</a>
      </div>

      <div v-if="userLoggedIn">
        <form name="logout" action="/logout" method="post">
          <input type="hidden" name="_token" id="csrf-token" :value="csrf" />
          <button type="submit" class="menu-link">Logout</button>
        </form>
      </div>
    </nav>
  </div>
</template>


<script>
import Options from "@/components/options/Options";

export default {
  props: {
    menuButtons: {
      type: Array,
    },
  },
  components: {
    Options,
  },
  data() {
    return {
      csrf: document.head.querySelector('meta[name="csrf-token"]').content,
      view: "/",
      showOptions: false,
    };
  },

  computed: {
    userLoggedIn: {
      get() {
        return this.$store.state.userLoggedIn;
      },
    },
  },

  methods: {
    allowedToView(guest) {
      if (guest) return true;
      if (this.userLoggedIn) return true;
    },
  },
};
</script>
