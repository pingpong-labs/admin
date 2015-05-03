<?php
$id = str_random();
?>
<a data-toggle="modal" href="#popup-{!! $id !!}">
  {!! $title !!}
</a>
<div id="popup-{!! $id !!}" class="modal text-left fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h1 class="modal-title">
          {!! $title !!}
        </h1>
      </div>
      <div class="modal-body">
        <p>
          {!! $message !!}
        </p>
      </div>
      <div class="modal-footer">
        <a href="{!! $url !!}" class="btn btn-primary">Yes</a>
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
      </div>
      {!! Form::close() !!}
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
