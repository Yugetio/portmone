const path = require('path')
const pkg = require('./package')

// Нам потрібен Mock щоб не залежати від back-end
// Для цього ставимо webpack-api-mocker

const apiMocker = require('webpack-api-mocker');

module.exports = {
  devServer: {
     before(app){ // Всі запити спочатку обробляються ./mocker/index.js там всі правила, щоб тут не заважали
         apiMocker(app, require.resolve('./mocker/index.js'))
     }
  },
  entry: [
    'src/polyfills.js',
    'src/index.js'
  ],
  html: {
    title: pkg.productName,
    description: pkg.description,
    template: path.join(__dirname, 'index.ejs')
  },
  postcss: {
    plugins: [
      // Your postcss plugins
    ]
  },
  presets: [
    require('poi-preset-bundle-report')(),
    require('poi-preset-offline')({
      pwa: './src/pwa.js', // Path to pwa runtime entry
      pluginOptions: {} // Additional options for offline-plugin
    })
  ]
}

