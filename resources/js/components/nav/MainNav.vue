<template>
  <div>
    <MobileNav
      :menuOpened="menuOpened"
      :menuButtons="menuButtons"
      @emitClicked="closeMenu()"
      v-if="screenWidth <= mobileMenuBreakpoint"
    ></MobileNav>
    <DesktopNav
      :menuButtons="menuButtons"
      v-if="screenWidth > mobileMenuBreakpoint"
    ></DesktopNav>
  </div>
</template>


<script>
import MobileNav from "@/components/nav/MobileNav";
import DesktopNav from "@/components/nav/DesktopNav";

export default {
  props: {
    menuOpened: {
      type: Boolean,
      default: false,
    },
    mobileMenuBreakpoint: {
      type: Number,
      default: 768,
    },
  },

  components: {
    MobileNav,
    DesktopNav,
  },

  computed: {
    userLoggedIn: {
      get() {
        return this.$store.state.userLoggedIn;
      },
    },
  },

  data() {
    return {
      menuButtons: [
        { name: "menuitems.index", label: "Weekly menu", guest: false },
        {
          name: "meals.menuitems",
          label: "Pick today's menu",
          guest: false,
        },
        { name: "meals.index", label: "Meals", guest: false },
        { name: "mealtypes.index", label: "Mealtypes", guest: false },
        { name: "cookbooks.index", label: "Cookbooks", guest: false },
        { name: "options.index", label: "Options", guest: false },
      ],
      csrf: document.head.querySelector('meta[name="csrf-token"]').content,
      view: "/",
      showOptions: false,
      txt: "",
      screenWidth: window.innerWidth,
    };
  },

  methods: {
    onResize() {
      this.screenWidth = window.innerWidth;
    },
    closeMenu() {
      this.$emit("emitClicked", false);
    },
  },
  mounted() {
    this.$nextTick(() => {
      window.addEventListener("resize", this.onResize);
    });
  },

  beforeDestroy() {
    window.removeEventListener("resize", this.onResize);
  },
};
</script>
