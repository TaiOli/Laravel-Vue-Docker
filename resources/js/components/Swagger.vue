<template>
    <div class="swagger-container">
      <iframe src="http://localhost:8000/api/documentacao"></iframe>
    </div>
  </template>
  
  <script>
  export default {
    name: 'Swagger'
  }
  </script>
  
  <style scoped>
    .swagger-container {
        height: 65vh; 
        width: 65vw;  
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 2%;
        margin: 0;
    }

    iframe {
        border: none; 
        height: 100%; 
        width: 100%;  
    }
  </style>  