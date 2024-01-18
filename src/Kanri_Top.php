<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.0/css/bulma.min.css">
</head>
<body>
    <h1>平井賢太</h1>
    <div id="app">
    <div class="tabs is-centered">
      <ul>
        <li v-for="tab in tabs" :key="tab.title" @click="setActiveTab(tab)" :class="{ 'is-active': tab === activeTab }">
          <a>{{ tab.title }}</a>
        </li>
      </ul>
    </div>
    <div v-if="activeTab" class="buttons is-centered"> <!-- is-centered クラスを追加 -->
      <form @submit.prevent>
        <button v-for="action in activeTab.actions" :key="action" @click="performAction(activeTab, action)" class="button is-primary">
          {{ action }}
        </button>
      </form>
    </div>
  </div>
    <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
    <script src="script.js"></script>
</body>
</html>