<div class="form-group row p-0 m-0 mb-5">
    <label class="col-form-label">{{trans('Car::car.form.attachments')}}</label>
    <input type="file" class="form-control col-md-8" name="attachments[]" multiple>
</div>
@isset($model)
<div class="row">
@foreach($model->attachments_url as $attachment_url)
<div class="my-gallery col-3 " itemscope="" itemtype="" style="position: unset;">
   <figure itemprop="associatedMedia" itemscope="" style="position: relative;">
        <a href="{{ $attachment_url }}" itemprop="contentUrl" data-size="555x370" style="position:absolute;left: 60%;top: 50%;"><i class="fa fa-search"></i></a>
        <img src="{{ $attachment_url }}" itemprop="thumbnail" width="200" height="200">
    </figure>
</div>
@endforeach
</div>
@endisset