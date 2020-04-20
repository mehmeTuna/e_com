import React from 'react'
import Swal from 'sweetalert2'
import withReactContent from 'sweetalert2-react-content'
import axios from 'axios'
import {Typography, Container, Grid, Button, Paper} from '@material-ui/core'

import OrdersTable from './components/orders-table'

const sweet = withReactContent(Swal)

export default class Orders extends React.Component {
  constructor(props) {
    super(props)

    this.state = {
      page: 'wait',
      orders: [],
      tabStatus: 1
    }
    this.orderDelete = this.orderDelete.bind(this)
    this.orderconfirm = this.orderconfirm.bind(this)
    this.changeTab = this.changeTab.bind(this)
  }

  async componentDidMount() {
    this.changeTab(1)
  }

  async changeTab(val) {
    this.setState({tabStatus: val})
    let tabChange = 'coming'
    switch (val) {
      case 1:
        tabChange = 'coming'
        break
      case 2:
        tabChange = 'approved'
        break
      case 3:
        tabChange = 'cancel'
        break
    }
    const {data} = await axios.get(`/orders?type=${tabChange}`)

    if (data.status === true) {
      this.setState({orders: data.data})
    }
  }

  orderconfirm(id) {
    sweet
      .mixin({
        title: 'Kargo Firmasi ve Kargo takip numarasi giriniz',
        confirmButtonText: 'Ileri &rarr;',
        input: 'text',
        progressSteps: ['1', '2']
      })
      .queue(['Kargo Firmasi', 'Kargo Takip numarasi'])
      .then(result => {
        if (typeof result.value !== 'undefined') {
          if (result.value[0] === '' && result.value[1] === '') {
            sweet.fire({
              title: 'Gecerli degerler giriniz',
              timer: 1500
            })
            return
          }
          axios
            .post('/orders/update', {
              id: id,
              company: result.value[0],
              trackingNumber: result.value[1]
            })
            .then(result => {
              if (result.data.status === true) {
                window.location.reload()
              } else {
                sweet.fire('Siparis onaylanmadi')
              }
            })
        }
      })
  }

  async orderDelete(id) {
    const {data} = await axios.delete('/orders', {
      id: id
    })
    if (data.status === true) {
      sweet.fire('Siparis Iptal Edildi')
    } else {
      sweet.fire('Siparis Iptal Edilemedi')
    }
  }

  render() {
    return (
      <React.Fragment>
        <Container>
          <Grid
            container
            direction="row"
            justify="center"
            alignItems="center"
            spacing={3}
          >
            <Grid item xs={3}>
              <Button
                onClick={() => this.changeTab(1)}
                variant="contained"
                color="primary"
              >
                Gelen Siparisler
              </Button>
            </Grid>
            <Grid item xs={3}>
              <Button
                onClick={() => this.changeTab(2)}
                variant="contained"
                color="primary"
              >
                Onaylanan Siparisler
              </Button>
            </Grid>
            <Grid item xs={3}>
              <Button
                onClick={() => this.changeTab(3)}
                variant="contained"
                color="primary"
              >
                Iptal Edilen Siparisler
              </Button>
            </Grid>
          </Grid>
          <div className="mt-4">
            {this.state.tabStatus == 1 && (
              <Typography align="center" variant="h4" gutterBottom>
                Gelen Siparisler
              </Typography>
            )}
            {this.state.tabStatus == 2 && (
              <Typography align="center" variant="h4" gutterBottom>
                Onaylanan Siparisler
              </Typography>
            )}
            {this.state.tabStatus == 3 && (
              <Typography align="center" variant="h4" gutterBottom>
                Iptal Olan Siparisler
              </Typography>
            )}
            {this.state.orders.length > 0 && (
              <Paper>
                <OrdersTable orders={this.state.orders} />
              </Paper>
            )}
            {this.state.orders.length === 0 && (
              <Typography align="center" variant="h4" gutterBottom>
                Siparis Bulunamadi
              </Typography>
            )}
          </div>
        </Container>
      </React.Fragment>
    )
  }
}
