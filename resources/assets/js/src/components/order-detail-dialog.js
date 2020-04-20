import React from 'react'
import {withStyles} from '@material-ui/core/styles'
import Button from '@material-ui/core/Button'
import Dialog from '@material-ui/core/Dialog'
import MuiDialogTitle from '@material-ui/core/DialogTitle'
import MuiDialogContent from '@material-ui/core/DialogContent'
import MuiDialogActions from '@material-ui/core/DialogActions'
import IconButton from '@material-ui/core/IconButton'
import CloseIcon from '@material-ui/icons/Close'
import Typography from '@material-ui/core/Typography'
import Grid from '@material-ui/core/Grid'
import TextField from '@material-ui/core/TextField'
import Snackbar from '@material-ui/core/Snackbar'
import ScrollDialog from './text-message'

const styles = theme => ({
  root: {
    margin: 0,
    padding: theme.spacing(2)
  },
  closeButton: {
    position: 'absolute',
    right: theme.spacing(1),
    top: theme.spacing(1),
    color: theme.palette.grey[500]
  }
})

const DialogTitle = withStyles(styles)(props => {
  const {children, classes, onClose, ...other} = props
  return (
    <MuiDialogTitle disableTypography className={classes.root} {...other}>
      <Typography variant="h6">{children}</Typography>
      {onClose ? (
        <IconButton
          aria-label="close"
          className={classes.closeButton}
          onClick={onClose}
        >
          <CloseIcon />
        </IconButton>
      ) : null}
    </MuiDialogTitle>
  )
})

const DialogContent = withStyles(theme => ({
  root: {
    padding: theme.spacing(2)
  }
}))(MuiDialogContent)

const DialogActions = withStyles(theme => ({
  root: {
    margin: 0,
    padding: theme.spacing(1)
  }
}))(MuiDialogActions)

const OptionRender = ({data}) => {
  return data.map((e, key) => <span key={key}>( {e.name} )</span>)
}

const confirmOrder = (id, trackingNumber, company, control, setMessageData) => {
  if (trackingNumber === '' || company === '') {
    control(true)
    return
  }
  axios
    .post('/orders/update', {
      id: id,
      type: 'onay',
      trackingNumber: trackingNumber,
      company: company
    })
    .then(res => {
      if (res.data.status == true) {
        setMessageData()
      }
    })
}

export default function OrderDetailDialog({open, data, setIsModalOpen}) {
  const [dialogOpen, setDialogOpen] = React.useState(false)
  const [trackingNumber, setTrackingNumber] = React.useState(
    data.trackingNumber === null ? '' : data.trackingNumber
  )
  const [company, setCompany] = React.useState(
    data.company === null ? '' : data.company
  )
  const [controlData, setControlData] = React.useState(false)

  const [setMessage, setStateMessage] = React.useState({
    messageOpen: false,
    vertical: 'top',
    horizontal: 'center'
  })

  const {vertical, horizontal, messageOpen} = setMessage

  const setMessageData = data => {
    setStateMessage(Object.assign({}, setMessage, {messageOpen: !messageOpen}))
  }

  return (
    <div>
      {messageOpen === true && (
        <Snackbar
          role="alert"
          anchorOrigin={{vertical, horizontal}}
          key={`${vertical},${horizontal}`}
          open={messageOpen}
          onClose={setMessageData}
          message="Siparis Onaylandi"
        />
      )}
      {dialogOpen && (
        <ScrollDialog
          open={dialogOpen}
          setOpen={() => setDialogOpen(!dialogOpen)}
          setData={data.id}
        />
      )}
      <Dialog
        onClose={setIsModalOpen}
        fullWidth={true}
        maxWidth="xl"
        aria-labelledby="customized-dialog-title"
        open={open}
      >
        <DialogTitle id="customized-dialog-title" onClose={setIsModalOpen}>
          {`${data.id} numarali siparis detaylari`}
        </DialogTitle>
        <DialogContent dividers>
          <Grid container spacing={3}>
            <Grid
              item
              xs={12}
              md={3}
              container
              direction="row"
              justify="center"
              alignItems="center"
            >
              <Typography gutterBottom>
                Ad Soyad: {data.user.firstname} <br />
                Telefon: {data.user.phone} <br />
                Adres: {data.adress} <br />
                Siparis Tarihi: {data.created_at} <br />
              </Typography>
            </Grid>
            <Grid item xs={12} md={9}>
              <Typography m={1}>
                Siparisi onaylamak icin kargo firmasi adini ve siparis takip
                numarasini girmek zorundasiniz. Bilgileri girdikten sonra
                Siparisi Onayla tusuna basiniz.
              </Typography>
              <form noValidate autoComplete="off">
                <Grid
                  container
                  direction="row"
                  justify="center"
                  alignItems="center"
                >
                  <Grid item xs={9} md={4} lg={3}>
                    <TextField
                      error={controlData === true && company === ''}
                      margin="normal"
                      id="standard-basic"
                      value={company}
                      onChange={e => setCompany(e.target.value)}
                      label="Kargo Firma Adi"
                    />
                  </Grid>
                  <Grid item xs={9} md={4} lg={3}>
                    <TextField
                      error={controlData === true && trackingNumber === ''}
                      margin="normal"
                      id="standard-basic"
                      value={trackingNumber}
                      onChange={e => setTrackingNumber(e.target.value.trim())}
                      label="Siparis Takip Numarasi"
                    />
                  </Grid>
                  <Grid item xs={9} md={4} lg={3}>
                    <Button
                      m={2}
                      variant="contained"
                      color="primary"
                      onClick={() =>
                        confirmOrder(
                          data.id,
                          trackingNumber,
                          company,
                          setControlData,
                          setMessageData
                        )
                      }
                    >
                      Siparisi Onayla
                    </Button>
                  </Grid>
                </Grid>
              </form>
            </Grid>
            <Grid item xs={12} md={12} lg={12}>
              <Typography gutterBottom>
                Siparis Detaylari: <br />
                {data.items.map((e, key) => (
                  <Typography key={key} gutterBottom>
                    1 x {e.product.name}{' '}
                    {e.check_box.length > 0 && (
                      <OptionRender data={e.check_box} />
                    )}
                    {e.select_box.length > 0 && (
                      <OptionRender data={e.select_box} />
                    )}
                  </Typography>
                ))}
              </Typography>
            </Grid>
          </Grid>
        </DialogContent>
        <DialogActions>
          <Button
            variant="contained"
            color="primary"
            onClick={() => setDialogOpen(true)}
          >
            Siparisi Iptal Et
          </Button>
        </DialogActions>
      </Dialog>
    </div>
  )
}
