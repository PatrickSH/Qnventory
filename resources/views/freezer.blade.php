@extends('layouts.root')
@extends('layouts.logo')
@extends('layouts.security')
@extends('layouts.user_data')

@section('content')
    <div id="freezer-page">
        <list-org-freezers></list-org-freezers>
    </div>
@endsection
@section('outercontent')
    <modal custom-class="editfreezer">
        <template slot="title" slot-scope="slot_data">
            <h2>Edit freezer @{{ slot_data.slotprops.freezer_editing_open.name }}</h2>
        </template>
        <template slot="content" slot-scope="slot_data">
            <div class="input-groups">
                <div class="group">
                    <input type="text" class="float-input-label" v-model="slot_data.slotprops.freezer_editing_open.name" placeholder=" "/>
                    <label class="label-floating">New freezer name</label>
                </div>

                <div class="group textarea">
                    <textarea class="float-input-label" v-model="slot_data.slotprops.freezer_editing_open.desc" placeholder=" "></textarea>
                    <label class="label-floating">New freezer description</label>
                </div>
            </div>
        </template>
        <template slot="buttons" slot-scope="slot_data">
            <button class="bluebutton"
                    v-show-loading-close
                    v-on:click="$root.$emit('freezer_editing_save', {id : slot_data.slotprops.freezer_editing_open.id, name : slot_data.slotprops.freezer_editing_open.name, desc : slot_data.slotprops.freezer_editing_open.desc});">Edit<span class="dot"></span>
                <span class="dot"></span>
                <span class="dot"></span>
                <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52"><circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/><path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/></svg></button>
        </template>
    </modal><!--/-->
    <modal custom-class="createFreezer">
        <template slot="title" slot-scope="slot_data">
            <h2>Create freezer</h2>
        </template>
        <template slot="content" slot-scope="slot_data">
            <div class="input-groups">
                <div class="group">
                    <input type="text" class="float-input-label" v-model="slot_data.slotprops.freezer_editing_open.name" placeholder=" "/>
                    <label class="label-floating">Freezer name</label>
                </div>
                <div class="group textarea">
                    <textarea class="float-input-label" v-model="slot_data.slotprops.freezer_editing_open.desc" placeholder=" "></textarea>
                    <label class="label-floating">Freezer description</label>
                </div>
            </div>
        </template>
        <template slot="buttons" slot-scope="slot_data">
            <button class="bluebutton"
                    v-show-loading-close
                    v-on:click="$root.$emit('freezer_creating', {name : slot_data.slotprops.freezer_editing_open.name, desc : slot_data.slotprops.freezer_editing_open.desc});">Save<span class="dot"></span>
                <span class="dot"></span>
                <span class="dot"></span>
                <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52"><circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/><path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/></svg></button>
        </template>
    </modal>
@endsection