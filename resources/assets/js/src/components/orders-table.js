import React from 'react'
import {Button} from '@material-ui/core'

import OrderDetailDialog from './order-detail-dialog'

const OrderDetails = () => {
  return <div>Siparis detalari</div>
}

const OrdersTable = ({orders}) => {
  const [isModalOpen, setIsModalOpen] = React.useState(false)
  const [orderData, setOrdersData] = React.useState({})

  return (
    <>
      {isModalOpen && (
        <OrderDetailDialog
          setIsModalOpen={() => setIsModalOpen(!open)}
          open={isModalOpen}
          data={orderData}
        />
      )}
      <table className="table mt-4">
        <thead>
          <tr>
            <th scope="col">Detaylar</th>
            <th scope="col">Id</th>
            <th scope="col">Ad Soyad</th>
            <th>Tarih</th>
            <th scope="col">Tutar</th>
          </tr>
        </thead>
        <tbody>
          {orders.map((e, key) => (
            <tr key={key}>
              <td>
                <Button
                  variant="contained"
                  onClick={() => {
                    setOrdersData(e)
                    setIsModalOpen(!isModalOpen)
                  }}
                >
                  Detaylar
                </Button>
              </td>
              <td>{e.id}</td>
              <td>{e.user.firstname}</td>
              <td>{e.created_at}</td>
              <td>{e.order_amount}</td>
            </tr>
          ))}
        </tbody>
      </table>
    </>
  )
}

export default OrdersTable
