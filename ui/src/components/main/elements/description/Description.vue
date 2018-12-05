<template>

<section class="description">
  <h1>{{header}}</h1>
  <p class="secondary-text">{{subheader}}</p>
  <p class="description-text">{{text}}</p>
</section>

</template>

<script>

    export default {
        data() {
            return { // Це можна буде замінити файлом перекладів з vue-i18n та локалізувати
                header: "Створити електронний гаманець",
                subheader: "Все просто!",
                text: "Molestias excepturi sint, obcaecati cupiditate non numquam eius modi.\n" +
                "Accusantium doloremque laudantidfgfum, totam rem aperiam eaque ipsa quae.\n" +
                "Hic tenetur a sapiente delectus, ut perspiciatis, unde omnis iste natus error."
            }
        }
    }

</script>

<style>
/*
  Vue славиться тим, що можна писати стилі компонента прямо в файлі компонента
  Якщо вам потрібні якісь спільні для всі дані, то очевидно, що їх можа використовувати з @import
  але просто виводити css компонента в окремий файл - не коректно
*/
  .description {
    padding: 200px 20px;
    align-items: center;
    background: url(./../../../../assets/images/desk.jpg) no-repeat;
    background-position: 5% 50%;
  }

  h1 {
    font-weight: bold;
    font-size: 36px;
    text-transform: uppercase;
    line-height: 1.2;
    text-align: right;
    padding-bottom: 20px;
    width: 80%;
    margin-right: -52px;
  }

  p {
    width: 88%
  }

  .secondary-text {
    text-align: right;
    color: #777;
    font-weight: 400;
    line-height: 1;
    font-size: 32px;
    padding-bottom: 20px;
  }

  .description-text {
    text-align: right;
    font-weight: 200;
    font-family: -apple-system, ".SFNSText-Regular", "San Francisco", Roboto, "Segoe UI", "Helvetica Neue", "Lucida Grande", sans-serif;
  }

</style>
