<template>
  <div id="hospitalMapWrapper" class="hospital-map">
  </div>
</template>

<script>
import * as d3 from 'd3';
import hospitalMapSvg from '@images/maps/hospital-map.svg';

export default {
  props: {
    aeWaitingTimeData: {
      type: Array,
      required: true
    }
  },
  data() {
    return {
      mapWidth: 1088,
      mapHeight: 1042
    };
  },
  methods: {
    generateMap() {
      d3.xml(hospitalMapSvg).then((data) => {
        d3.select('#hospitalMapWrapper').node().append(data.documentElement);
        this.addWaitingTime();
      });
    },
    addWaitingTime() {
      const svg = d3.select('#hospitalMap');
      const g = d3.select('#hospitalMap #hospitalMapGroup');

      const waitingTimeGroup = g.append('g')
        .attr('id', 'hospitalWaitingTimeGroup')
        .selectAll('path')
        .data(this.aeWaitingTimeData)
        .enter();

      // Zoom functions
      const zoom = d3.zoom()
        .scaleExtent([1, 8])
        .translateExtent([
          [0, 0],
          [this.mapWidth, this.mapHeight]
        ])
        .on('zoom', () => {
          const { transform } = d3.event;
          g.attr('transform', transform);
        })
        .filter(() => {
          // Disable swipe when map is not zoomed for normal page scrolling
          // Only working on iOS
          const { type, touches } = d3.event;
          return !(type === 'touchstart' && touches.length < 2 && d3.zoomTransform(svg.node()).k === 1);
        });

      // Waiting Time label
      waitingTimeGroup.append('text')
        .attr('class', 'hospital-map__time-label')
        .attr('transform', (d) => {
          const labelBackground = d3.select(`.hospital-map__labels g[data-label=${d.hospName}] .hospital-map__time-background`)
            .node();
          const {
            x,
            y,
            width,
            height
          } = labelBackground.getBBox();

          return `translate(${x + (width / 2)}, ${y + 2 + (height / 2)})`;
        })
        .attr('dominant-baseline', 'middle')
        .attr('text-anchor', 'middle')
        .attr('font-size', 24)
        .attr('fill', '#aa362a')
        .text((d) => d.topWait);

      const gNode = () => g.node();
      svg.append(gNode);

      // Add zoom functionality, disable wheel and double click zoom
      svg.call(zoom)
        .on('wheel.zoom', null)
        .on('dblclick.zoom', null);
    }
  },
  mounted() {
    this.generateMap();
  },
  watch: {
    aeWaitingTimeData() {
      // Redraw map on props change
      d3.select('#hospitalWaitingTimeGroup').remove();
      this.addWaitingTime();
    }
  }
};
</script>

<style lang='scss' scoped>
  .hospital-map {
    svg {
      width: 100%;
      display: block;
    }
  }
</style>
