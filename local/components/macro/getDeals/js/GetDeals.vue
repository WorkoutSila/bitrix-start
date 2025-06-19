<script>
import { ref, onMounted } from 'vue';
import 'element-plus/dist/index.css'
export default {
    name: 'DealListComponent',
    setup() {
      const deals = ref([]);
      const loading = ref(false);
      const error = ref(null);

      const fetchDeals = async () => {
          loading.value = true;
          error.value = null;
          console.log("Получение сделок из ORM")

          BX.ajax.runComponentAction(
            'macro:getDeals', 'listDeals', 
            {
              mode: 'ajax',
              data: {

              }
            })
          .then(function (response) {
            deals.value = JSON.parse(response.data)
          }).catch(function(error) {
            console.log("Ошибка получения сделок", error)
          });
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
  <div class="table" v-if="deals">
      <el-table
        :data="deals"
        :default-sort="{ prop: 'OPPORTUNITY', order: 'ascending' }"
        style="width: 100%"
      >
        <el-table-column prop="TITLE" label="Заголовок" sortable >
          <template #default="scope">
            <span class="text-1xl font-bold"> {{scope.row.TITLE}}</span>
          </template>
        </el-table-column>
        <el-table-column prop="OPPORTUNITY" label="Потенциал" />
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