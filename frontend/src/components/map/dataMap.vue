<template>
  <div class="data-map">
    <svg id="whpMap"></svg>
  </div>
</template>

<script>
import * as d3 from 'd3';
import { geoMercator, geoPath } from 'd3-geo';
import chinaGeoJson from '@data/geojson/china.json';

export default {
  props: {
    provinceSummary: {
      type: Array,
      required: true
    }
  },
  data() {
    return {
      mapWidth: 680,
      mapHeight: 500,
      provinceFocused: null,
      legendFocused: false
    };
  },
  methods: {
    getProvinceStatistics(d) {
      const currentProvince = this.provinceSummary.filter(
        (p) => p.provinceName === d.properties.name
      );

      // For old getStatisticsService use
      // const provinceTags = (currentProvince.length && Array.isArray(currentProvince) && currentProvince[0].tags) || '';
      // return extractStatistic(provinceTags);

      return (currentProvince.length && Array.isArray(currentProvince)
        ? currentProvince[0]
        : {
          confirmedCount: 0,
          suspectedCount: 0,
          curedCount: 0,
          deadCount: 0
        }
      );
    },
    generateMap() {
      const chartColors = {
        red: ['#cc4c4a', '#d66f70', '#e09492', '#ebb8b7', '#f5dcdd', '#fefcfc'],
        yellow: '#fbf6e6',
        green: '#f8fdf5',
        white: '#ffffff',
        darkRed: '#aa362a'
      };

      const projection = geoMercator()
        .scale(550)
        .center([105, 38]) // lat, long as center
        .translate([this.mapWidth / 2, this.mapHeight / 2]); // SVG center

      const path = geoPath(projection);

      const svg = d3.select('#whpMap')
        .attr('viewBox', `0 0 ${this.mapWidth} ${this.mapHeight}`);

      const g = d3.create('svg:g')
        .attr('id', 'mapGroup');

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
        });

      // Reset zoom
      const reset = () => {
        this.legendFocused = false;
        this.provinceFocused = null;

        svg.transition().duration(750).call(
          zoom.transform,
          d3.zoomIdentity,
          d3.zoomTransform(svg.node()).invert([this.mapWidth / 2, this.mapHeight / 2])
        );
      };

      // Zoom Province
      const provinceClicked = (data) => {
        let focusedProvinceName;

        if (this.provinceFocused) {
          const {
            properties: { name: provinceName }
          } = this.provinceFocused;

          focusedProvinceName = provinceName;
        }

        if ((this.provinceFocused === null && data)
          || (data && focusedProvinceName !== data.properties.name)) {
          this.legendFocused = false;
          this.provinceFocused = data;

          const [[x0, y0], [x1, y1]] = path.bounds(data);
          d3.event.stopPropagation();
          svg.transition().duration(750).call(
            zoom.transform,
            d3.zoomIdentity
              .translate(this.mapWidth / 2, this.mapHeight / 2)
              .scale(
                Math.min(8, 0.9 / Math.max((x1 - x0) / this.mapWidth, (y1 - y0) / this.mapHeight))
              )
              .translate(-(x0 + x1) / 2, -(y0 + y1) / 2),
            d3.mouse(svg.node())
          );
        } else {
          reset();
        }
      };

      const legendClicked = () => {
        this.provinceFocused = null;

        if (!this.legendFocused) {
          this.legendFocused = true;

          d3.event.stopPropagation();
          svg.transition().duration(750).call(
            zoom.transform,
            d3.zoomIdentity
              .translate(this.mapWidth / 2, this.mapHeight / 2)
              .scale(4)
              .translate(-590, -435),
            d3.mouse(svg.node())
          );
        } else {
          reset();
        }
      };

      svg.on('click', reset);

      svg.append('rect')
        .attr('id', 'mapBackground')
        .attr('width', this.mapWidth)
        .attr('height', this.mapHeight)
        .attr('fill', 'none')
        .on('click', reset);

      const provinceGroup = g.append('g')
        .attr('id', 'mapProvinces')
        .selectAll('path')
        .data(chinaGeoJson.features)
        .enter();

      // Province path
      provinceGroup.append('path')
        .attr('d', path)
        .attr('fill', (d) => {
          const provinceStatistic = this.getProvinceStatistics(d);

          if (provinceStatistic.confirmedCount > 0) {
            const { red: redScale } = chartColors;
            // Scale: >=100, 10 - 99, 1 - 9
            return (
              provinceStatistic.confirmedCount >= 100
                ? redScale[0]
                : provinceStatistic.confirmedCount >= 10
                  ? redScale[2]
                  : redScale[4]
            );
          }

          if (provinceStatistic.suspectedCount > 0) {
            return chartColors.yellow;
          }

          return chartColors.green;
        })
        .attr('stroke', chartColors.darkRed)
        .attr('stroke-width', 1)
        .on('click', provinceClicked);

      // Province label
      provinceGroup.append('text')
        .attr('id', (d) => `mapLabel${d.properties.id}`)
        .attr('transform', (d) => {
          let offsetX = 0;
          let offsetY = 0;
          let line;
          const [cx, cy] = path.centroid(d);

          // Hard-coded offset and pointer for better display
          switch (d.properties.id) {
            case '11': // 北京市
              offsetX = 110;
              offsetY = 2;
              line = [cx, cy, cx + 97, cy];
              break;
            case '12': // 天津市
              offsetX = 60;
              offsetY = 15;
              line = [cx, cy, cx + 47, cy + 12];
              break;
            case '13': // 河北省
              offsetX = -70;
              offsetY = -85;
              line = [cx - 10, cy + 10, cx - 67, cy - 80];
              break;
            case '15': // 內蒙古自治區
              offsetX = 15;
              offsetY = 15;
              break;
            case '23': // 黑龍江省
              offsetY = 15;
              break;
            case '31': // 上海市
              offsetX = 30;
              line = [cx, cy, cx + 16, cy - 2];
              break;
            case '32': // 江蘇省
              offsetX = -1;
              offsetY = -4;
              break;
            case '34': // 安徽省
              offsetX = 1;
              offsetY = 10;
              break;
            case '36': // 江西省
              offsetX = -1;
              break;
            case '37': // 山東省
              offsetY = 3;
              break;
            case '46': // 海南省
              offsetX = -50;
              line = [cx, cy, cx - 35, cy - 2];
              break;
            case '50': // 重慶市
              offsetX = -6;
              offsetY = 8;
              break;
            case '61': // 陝西省
              offsetY = 18;
              break;
            case '62': // 甘肅省
              offsetX = -30;
              offsetY = -21;
              break;
            case '64': // 寧夏回族自治區
              offsetY = -80;
              line = [cx, cy, cx, cy - 75];
              break;
            case '66': // 香港
              offsetY = 30;
              line = [cx, cy, cx, cy + 20];
              break;
            case '68': // 台灣
              offsetX = 30;
              offsetY = 10;
              line = [cx, cy, cx + 20, cy + 8];
              break;
            case '76': // 澳門
              offsetX = -10;
              offsetY = 20;
              line = [cx, cy, cx - 5, cy + 12];
              break;
            default:
              break;
          }

          if (line) {
            provinceGroup.append('line')
              .attr('id', `mapLine${d.properties.id}`)
              .attr('x1', line[0])
              .attr('y1', line[1])
              .attr('x2', line[2])
              .attr('y2', line[3])
              .attr('stroke', chartColors.darkRed)
              .attr('stroke-width', 0.5);
          }

          return `translate(${cx + offsetX}, ${cy + offsetY})`;
        })
        .attr('text-anchor', 'middle')
        .attr('font-size', 7)
        .attr('fill', (d) => {
          const provinceStatistic = this.getProvinceStatistics(d);
          const { properties: { id } } = d;
          const smallProvinces = ['11', '12', '13', '31', '46', '64', '66', '68', '76'];

          // Change text color when province is filled with dark red
          // Except those label which have pointer line
          return provinceStatistic.confirmedCount >= 10 && !smallProvinces.includes(id)
            ? chartColors.white
            : chartColors.darkRed;
        })
        .text((d) => d.properties.name)
        .on('click', provinceClicked);

      const legendData = [
        {
          color: chartColors.red[0],
          label: '>= 100'
        },
        {
          color: chartColors.red[2],
          label: '10 - 99'
        },
        {
          color: chartColors.red[4],
          label: '1 - 9'
        },
        {
          color: chartColors.yellow,
          label: '有懷疑個案'
        },
        {
          color: chartColors.green,
          label: '未有確診 / 懷疑個案'
        }
      ];

      const legend = g.append('g')
        .attr('id', 'mapLegend')
        .on('click', legendClicked)
        .selectAll('path')
        .data(legendData)
        .enter();

      legend.append('rect')
        .attr('x', 550)
        .attr('y', (d, i) => 400 + (20 * i))
        .attr('width', 12)
        .attr('height', 12)
        .attr('stroke', chartColors.darkRed)
        .attr('stroke-width', 1)
        .attr('fill', (d) => d.color);

      legend.append('text')
        .attr('x', 570)
        .attr('y', (d, i) => 408 + (20 * i))
        .attr('font-size', 7)
        .attr('fill', chartColors.darkRed)
        .text((d) => d.label);

      const gNode = () => g.node();
      svg.append(gNode);

      // Add zoom functionality
      svg.call(zoom);
    }
  },
  mounted() {
    this.generateMap();
  },
  watch: {
    provinceSummary() {
      // Redraw map on props change
      d3.select('#mapGroup').remove();
      d3.select('#mapBackground').remove();
      this.generateMap();
    }
  }
};
</script>

<style lang='scss' scoped>
  .data-map {
    svg {
      width: 100%;
      display: block;
    }
  }
</style>
