import React from 'react'
import Button from '@material-ui/core/Button'
import Dialog from '@material-ui/core/Dialog'
import DialogActions from '@material-ui/core/DialogActions'
import DialogContent from '@material-ui/core/DialogContent'
import DialogContentText from '@material-ui/core/DialogContentText'
import DialogTitle from '@material-ui/core/DialogTitle'
import axios from 'axios'

const orderIptal = id => {
  axios
    .post('/orders/update', {
      id: id,
      type: 'iptal'
    })
    .then(res => {
      if (res.data.status == true) {
        window.location.reload()
      }
    })
}

export default function ScrollDialog({open, setOpen, setData}) {
  return (
    <div>
      <Dialog
        open={open}
        onClose={setOpen}
        scroll="paper"
        aria-labelledby="scroll-dialog-title"
        aria-describedby="scroll-dialog-description"
      >
        <DialogTitle id="scroll-dialog-title">Siparisi Iptal Et</DialogTitle>
        <DialogContent dividers={true}>
          <DialogContentText id="scroll-dialog-description" tabIndex={-1}>
            Siparisi iptal ettiginiz taktirde musteriye belirtilen tutari iade
            etmeniz gerekmektedir. Sistem uzerinden iade islemi yapilmamaktadir.
          </DialogContentText>
        </DialogContent>
        <DialogActions>
          <Button onClick={() => orderIptal(setData)} color="primary">
            Iptal Et
          </Button>
          <Button onClick={setOpen} color="primary">
            Vazgec
          </Button>
        </DialogActions>
      </Dialog>
    </div>
  )
}
