new Vue({
    el: '#app',
    data() {
      return {
        activeTab: null,
        tabs: [
            { title: 'ゲーム', actions: ['一覧', '登録', '更新', '削除'], targets: ['game/game_itiran.php', 'game/game_touroku.php', 'game/game_kousin.php', 'game/game_sakujo.php'] },
            { title: 'ゲーム会社', actions: ['一覧', '登録', '更新', '削除'], targets: ['company/company_itiran.php', 'company/company_touroku.php', 'company/company_kousin.php', 'company/company_sakujo.php'] },
            { title: 'ジャンル', actions: ['一覧', '登録', '更新', '削除'], forms: ['genre/genre_itiran.php', 'genre/genre_touroku.php', 'genre/genre_kousin.php', 'genre/genre_sakujo.php'] },
            { title: 'キャラクター', actions: ['一覧', '登録', '更新', '削除'], forms: ['chara/chara_itiran.php', 'chara/chara_touroku.php', 'chara/chara_kousin.php', 'chara/chara_sakujo.php'] },
            { title: '総合ID', actions: ['一覧', '登録', '更新', '削除'], forms: ['allinfo/allinfo_itiran.php', 'allinfo/allinfo_touroku.php', 'allinfo/allinfo_kousin.php', 'allinfo/allinfo_sakujo.php'] }
        ]
      };
    },
    methods: {
        performAction(tab, action) {
          console.log(`Performing ${action} action for ${tab.title}`);
          const targetIndex = tab.actions.indexOf(action);
          if (targetIndex !== -1) {
            const target = tab.targets[targetIndex];
            window.location.href = target;
          }
        },
        setActiveTab(tab) {
          this.activeTab = tab;
        }
      },
      created() {
        // 初期のタブを設定
        this.activeTab = this.tabs[0];
      },
      template: `
        <div>
          <div class="tabs is-centered">
            <ul>
              <li v-for="tab in tabs" :key="tab.title" @click="setActiveTab(tab)" :class="{ 'is-active': tab === activeTab }">
                <a>{{ tab.title }}</a>
              </li>
            </ul>
          </div>
          <div v-if="activeTab" class="buttons is-centered">
            <form @submit.prevent>
              <button v-for="action in activeTab.actions" :key="action" @click="performAction(activeTab, action)" class="button is-primary">
                {{ action }}
              </button>
            </form>
          </div>
        </div>
      `
    });