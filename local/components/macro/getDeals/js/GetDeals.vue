<script>
import { ref, onMounted } from 'vue';
import 'element-plus/dist/index.css'
import axios from 'axios'
export default {
    name: 'DealListComponent',
    setup() {
      const deals = ref([]);
      const loading = ref(false);
      const error = ref(null);

      const fetchDeals = async () => {
          loading.value = true;
          error.value = null;
          // Можно будет импортировать тост с выводом ошибки

          try {
            const response = await axios.get('/local/ajax/getDeals.php')
            deals.value = response.data
            console.log("Сделки: ", deals.value)
          
          } catch (err) {
            console.log(err)
          } finally {
            loading.value = false
          }
      };

      onMounted(() => {
        // Получаем данные из ORM
          fetchDeals();
      });
          return {
            deals,
            loading,
            error,
            fetchDeals,
        };
    }
  }
</script>

<template>
  <!-- <div>
      <h2>Список сделок</h2>
      <el-button type="primary">Primary</el-button>

      <p v-if="loading">Загрузка...</p>
      <p v-if="error" style="color: red;">{{ error }}</p>

      <ul v-if="deals">
          <div v-for="deal in deals" :key="deal.id">
            <h1 class="text-3xl font-bold underline">{{ deal.TITLE }}</h1>
            <h2>{{ deal.OPPORTUNITY }}</h2>
            <h3>{{ deal.CURRENCY_ID }}</h3>
            <br>
          </div>
      </ul>
  </div> -->
  <div class="table" v-if="deals">
      <el-table
        :data="deals"
        :default-sort="{ prop: 'OPPORTUNITY', order: 'ascending' }"
        style="width: 100%"
      >
        <el-table-column prop="TITLE" label="Заголовок" sortable width="500" />
        <el-table-column prop="OPPORTUNITY" label="Потенциал" sortable width="500" />
        <!-- Разобраться с сортировкой по сумме -->
        <el-table-column prop="CURRENCY_ID" label="Валюта" />
      </el-table>
  </div>
  <div v-else>
    <p>Нет доступных сделок.</p>
  </div>
</template>


<style lang="scss" scoped>

.title {
  font-size: 25px;
}
ul div h1 {
  color: cadetblue;
  
}
div p {
  color: rgb(0, 89, 255);
}
.table {
  display: flex;
  align-items: center;
}
</style>