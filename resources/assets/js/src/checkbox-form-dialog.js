import React from 'react'
import Button from '@material-ui/core/Button'
import TextField from '@material-ui/core/TextField'
import Dialog from '@material-ui/core/Dialog'
import DialogActions from '@material-ui/core/DialogActions'
import DialogContent from '@material-ui/core/DialogContent'
import DialogContentText from '@material-ui/core/DialogContentText'
import DialogTitle from '@material-ui/core/DialogTitle'

export default function CheckBoxFormDialog({open, setOpen, setData}) {
  const [title, setTitle] = React.useState('')
  const [price, setPrice] = React.useState(1)

  const updateData = () => {
    if (title !== '' && price > 0) {
      setData({title: title, price: price})
    }
    setOpen()
  }

  return (
    <div>
      <Dialog open={open} onClose={setOpen} aria-labelledby="form-dialog-title">
        <DialogTitle id="form-dialog-title">Opsiyon Ekle</DialogTitle>
        <DialogContent>
          <DialogContentText>
            Opsiyon ve yeni fiyat giriniz. Yeni fiyat gecerli yeni fiyat
            olacaktir.
          </DialogContentText>
          <TextField
            autoFocus
            margin="dense"
            id="name"
            label="Opsiyon"
            value={title}
            onChange={e => setTitle(e.target.value)}
            type="text"
            fullWidth
          />
          <TextField
            autoFocus
            margin="dense"
            id="name"
            label="Yeni Fiyat"
            value={price}
            onChange={e => {
              if (e.target.value >= 0) {
                setPrice(e.target.value)
              }
            }}
            type="number"
            fullWidth
          />
        </DialogContent>
        <DialogActions>
          <Button onClick={setOpen} color="primary">
            Vazgec
          </Button>
          <Button onClick={updateData} color="primary">
            Ekle
          </Button>
        </DialogActions>
      </Dialog>
    </div>
  )
}
