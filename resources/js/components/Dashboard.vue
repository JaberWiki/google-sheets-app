<template>
  <div>
    <h1>Dashboard</h1>
    <div v-if="!isAuthenticated">
      <button @click="connectToGoogle">Connect to Google</button>
    </div>
    <div v-else>
      <h2>Select a Google Sheet</h2>
      <select v-model="selectedSheetId" @change="fetchSheetData">
        <option disabled value="">-- Select a Sheet --</option>
        <option v-for="sheet in sheets" :key="sheet.id" :value="sheet.id">
          {{ sheet.name }}
        </option>
      </select>

      <div v-if="sheetData.length">
        <h3>Sheet Data</h3>
        <table>
          <thead>
            <tr>
              <th v-for="(header, index) in sheetData[0]" :key="index">{{ header }}</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(row, rowIndex) in sheetData.slice(1)" :key="rowIndex">
              <td v-for="(cell, cellIndex) in row" :key="cellIndex">{{ cell }}</td>
            </tr>
          </tbody>
        </table>
      </div>
      <p v-else>No data available for this sheet.</p>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      isAuthenticated: false,
      sheets: [],
      selectedSheetId: '',
      sheetData: [],
      range: 'Sheet1!A1:E10', // Default range, can be updated as needed
    };
  },
  methods: {
    async connectToGoogle() {
      window.location.href = '/auth/google';
    },
    async fetchSheets() {
      try {
        const response = await axios.get('/api/sheets');
        this.sheets = response.data;
      } catch (error) {
        console.error('Error fetching sheets:', error);
      }
    },
    async fetchSheetData() {
      if (!this.selectedSheetId) return;
      try {
        const response = await axios.get(`/api/sheets/data/${this.selectedSheetId}/${this.range}`);
        this.sheetData = response.data;
      } catch (error) {
        console.error('Error fetching sheet data:', error);
      }
    },
  },
  async created() {
    try {
      const response = await axios.get('/api/user');
      this.isAuthenticated = response.status === 200;
      if (this.isAuthenticated) {
        await this.fetchSheets(); // Fetch list of sheets upon authentication
      }
    } catch (error) {
      this.isAuthenticated = false;
    }
  },
};
</script>
