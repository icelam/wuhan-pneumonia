<template>
  <a class="news-link" :href="articleUrl" target="_blank" rel="noopener noreferrer">
    <card class="news-card" :class="{'news-card--no-image': !articleImage}" smallPadding>
      <div class="news-card__image-block" v-if="articleImage">
        <div
          class="news-card__image"
          v-bind:style="{
            'background': `url(${articleImage}) center center / cover no-repeat`
          }"
        ></div>
      </div>

      <h4 class="news-card__title">{{articleTitle}}</h4>
      <p class="news-card__description">{{articleDescription}}</p>
      <div class="news-card__info">
        <span class="news-card__source" v-if="articleSource">
          {{articleSource}}
        </span>
        <span v-if="articleSource && articlePublishTime" class="news-card__info-separator">•</span>
        <span class="news-card__publish-date" v-if="articlePublishTime">
          {{articlePublishTime}}
        </span>
      </div>
    </card>
  </a>
</template>

<script>
import {
  card
} from '@components';

export default {
  components: {
    card
  },
  props: {
    articleTitle: {
      type: String,
      required: true
    },
    articleDescription: {
      type: String,
      required: true
    },
    articleUrl: {
      type: String,
      required: true
    },
    articleSource: {
      type: String,
      required: false,
      default: ''
    },
    articlePublishTime: {
      type: String,
      required: false,
      default: ''
    },
    articleImage: {
      type: String,
      required: false,
      default: undefined
    }
  }
};
</script>

<style lang='scss' scoped>
  @import './newsCard';
</style>
