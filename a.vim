

function! Callback(handle, msg)
  echo a:msg
endfunction


function! Ma(...)
  call ch_sendexpr(g:ch, 'foo', {'callback': 'Callback'})
endfunction


let g:ch = ch_open('127.0.0.1:8888')
" call ch_setoptions(g:ch, {'callback': 'Callback'})
" call ch_sendexpr(g:ch, 'foo')
