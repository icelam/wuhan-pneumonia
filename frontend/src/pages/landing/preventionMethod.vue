<template>
  <card class="prevention-method">
    <div class="row">
      <div class="column column--100 prevention-method__block1">
        <h4 class="headings--no-top-gutter">個人清潔</h4>
        <ul>
          <li><span>在搭乘交通工具或在人多擠逼的地方逗留時應佩戴外科口罩。正確佩戴口罩十分重要，在佩戴口罩前及脫下口罩後亦應保持手部衞生</span></li>
          <li><span>經常保持雙手清潔，尤其在觸摸口、鼻或眼之前</span></li>
          <li><span>觸摸扶手或門把等公共設施後；或當手被呼吸道分泌物污染時，如咳嗽或打噴嚏後亦應洗手</span></li>
          <li><span>洗手時應以梘液和清水清潔雙手，搓手最少20秒，用水過清並用抹手紙弄乾。</span></li>
          <li><span>如沒有洗手設施，或雙手沒有明顯污垢時，使用含 70 至 80% 的酒精搓手液潔淨雙手亦為有效方法</span></li>
          <li><span>打噴嚏或咳嗽時應用紙巾掩蓋口鼻，把用過的紙巾棄置於有蓋垃圾箱內，然後徹底清潔雙手</span></li>
        </ul>
      </div>

      <div class="column column--55 prevention-method__block2">
        <h4>盡量避免</h4>
        <ul>
          <li><span>避免前往人流密集的場所。如不可避免，應戴上外科口罩</span></li>
          <li><span>避免到訪醫院。如有必要應佩戴外科口罩及時刻注重個人和手部衛生</span></li>
          <li><span>避免接觸動物(包括野味)、禽鳥或其糞便</span></li>
          <li><span>避免到海鮮、家禽市場或農場</span></li>
        </ul>

        <h4>盡快就診</h4>
        <ul>
          <li><span>當出現呼吸道感染病徵，應戴上外科口罩，不應上班或上學，避免前往人多擠迫的地方，及盡早向醫生求診。</span></li>
        </ul>

        <div class="remarks">
          更多資訊請瀏覽香港特別行政區政府 衞生署 衞生防護中心網頁：<br/>
          <a href="https://www.chp.gov.hk/tc/features/102465.html" target="_blank" rel="noopener noreferrer">
            https://www.chp.gov.hk/tc/features/102465.html
          </a>
        </div>
      </div>

      <div class="column column--45 prevention-method__visual">
        <img src="~@images/visuals/stay-healthy.svg" alt="健康最重要！">
      </div>
    </div>
  </card>
</template>

<script>
import { card } from '@components';

export default {
  components: {
    card
  }
};
</script>

<style lang='scss' scoped>
  @import './preventionMethod';
</style>
