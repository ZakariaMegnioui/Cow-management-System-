<template>
  <!-- eslint-disable -->
  <div v-if="!item.hidden && item.children" class="menu-wrapper">
    <template
      v-if="
        hasOneShowingChild(item.children, item) &&
          (!onlyOneChild.children || onlyOneChild.noShowingChildren) &&
          !item.alwaysShow
      "
    >
      <app-link
        :to="resolvePath(onlyOneChild.path)"
        class=" flex justify-start items-center"
      >
        <el-menu-item
          :index="resolvePath(onlyOneChild.path)"
          :class="{ 'flex items-center bg-white': !isNest }"
        >
          <div class="items-transition flex items-center">
            <!-- hover white fixed:  submenu-title-noDropdown -->
            <item
              v-if="onlyOneChild.meta"
              :icon="onlyOneChild.meta.icon || item.meta.icon"
              :title="generateTitle(onlyOneChild.meta.title)"
            />
          </div>
        </el-menu-item>
      </app-link>
    </template>

    <el-submenu v-else :index="resolvePath(item.path)">
      <template slot="title">
        <!-- dropdown titles -->
        <div class="flex items-center text-gray-600 font-Montserrat ">
          <item
            v-if="item.meta"
            :icon="item.meta.icon"
            :title="generateTitle(item.meta.title)"
          />
        </div>
      </template>

      <template v-for="child in visibleChildren">
        <sidebar-item
          v-if="child.children && child.children.length > 0"
          :key="child.path"
          :is-nest="true"
          :item="child"
          :base-path="resolvePath(child.path)"
          class="nest-menu"
        />

        <!-- dropdowns -->

        <app-link v-else :key="child.name" :to="resolvePath(child.path)">
          <el-menu-item
            class="flex justify-start items-center bg-white hover:bg-red-500"
            :index="resolvePath(child.path)"
          >
            <div class="items-transition flex justify-start items-center">
              <item
                v-if="child.meta"
                :icon="child.meta.icon"
                :title="generateTitle(child.meta.title)"
              />
            </div>
          </el-menu-item>
        </app-link>
      </template>
    </el-submenu>
  </div>
</template>

<script>
/* eslint-disable */

import path from 'path';
import { isExternal } from '@/utils/validate';
import Item from './Item';
import AppLink from './Link';
import { generateTitle } from '@/utils/i18n';

export default {
  name: 'SidebarItem',
  components: { Item, AppLink },
  props: {
    // route object
    item: {
      type: Object,
      required: true,
    },
    isNest: {
      type: Boolean,
      default: false,
    },
    basePath: {
      type: String,
      default: '',
    },
  },
  data() {
    return {
      // modified
      onlyOneChild: null,
    };
  },
  computed: {
    visibleChildren() {
      return this.item.children.filter(item => !item.hidden);
    },
  },
  methods: {
    hasOneShowingChild(children, parent) {
      const showingChildren = children.filter(item => {
        if (item.hidden) {
          return false;
        } else {
          // Temp set(will be used if only has one showing child)
          this.onlyOneChild = item;
          return true;
        }
      });

      // When there is only one child router, the child router is displayed by default
      if (showingChildren.length === 1) {
        return true;
      }

      // Show parent if there are no child router to display
      if (showingChildren.length === 0) {
        this.onlyOneChild = { ...parent, path: '', noShowingChildren: true };
        return true;
      }

      return false;
    },
    resolvePath(routePath) {
      if (this.isExternalLink(routePath)) {
        return routePath;
      }
      return path.resolve(this.basePath, routePath);
    },
    isExternalLink(routePath) {
      return isExternal(routePath);
    },
    generateTitle,
  },
};
</script>

<style>
.items-transition {
  opacity: 1 !important ;
}
</style>