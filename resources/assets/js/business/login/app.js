import ReactDOM from 'react-dom'

require('./../../bootstrap')

window.React = require('react')

import Login from './src/app'

if (document.getElementById('root')) {
  ReactDOM.render(<Login />, document.getElementById('root'))
}
