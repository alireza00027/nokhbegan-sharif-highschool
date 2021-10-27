    <div>
        <td class="bg-{{$status['color']}}">{{$status['text']}}</td>
    <td>
        <input wire:model="point" name="point_{{$student->id}}" class="form-control" placeholder="عددی بین 0 تا 2">
    </td>
    <td>
        <button wire:click="analysisPoint" type="button" class="btn btn-sm btn-outline-primary">محاسبه</button>
    <td>    
    </div>
