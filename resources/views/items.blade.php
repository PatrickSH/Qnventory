@extends('layouts.root')
@extends('layouts.logo')
@extends('layouts.security')
@extends('layouts.user_data')

@section('content')
    <div id="items-page">
        <list-org-items></list-org-items>
    </div>
@endsection
@section('outercontent')
    <modal custom-class="edititem">
        <template slot="title" slot-scope="slot_data">
            <h2>Edit item</h2>
        </template>
        <template slot="content" slot-scope="slot_data">
            <div class="input-groups">
                <div class="group">
                    <input type="text" class="float-input-label" v-model="slot_data.slotprops.item_editing_open.label" placeholder=" "/>
                    <label class="label-floating">Item name</label>
                </div>
                <div class="group vue-date">
                    <v-date-picker v-model="slot_data.slotprops.item_editing_open.expires" :attributes="slot_data.slotprops.global.calendarAttrs"></v-date-picker>
                    <label class="label_under">Expires</label>
                </div>
                <div class="group vue-date">
                    <v-date-picker v-model="slot_data.slotprops.item_editing_open.bought" :attributes="slot_data.slotprops.global.calendarAttrs"></v-date-picker>
                    <label class="label_under">Bought</label>
                </div>
                <div class="group select">
                    <select name="category" v-model="slot_data.slotprops.item_editing_open.category" required>
                        <option v-for="cat in slot_data.slotprops.item_editing_open.cats[0]" v-bind:value="cat.id">@{{ cat.label }}</option>
                    </select>
                    <label class="label_under">Item category *</label>
                </div>
                <div class="group select">
                    <select name="category" v-model="slot_data.slotprops.item_editing_open.freezer" required>
                        <option v-for="freezer in slot_data.slotprops.item_editing_open.freezers[0]" v-bind:value="freezer.id">@{{ freezer.name }}</option>
                    </select>
                    <label class="label_under">Item freezer *</label>
                </div>
                <div class="group">
                    <input type="number" class="float-input-label" v-model="slot_data.slotprops.item_editing_open.weight" placeholder=" "/>
                    <label class="label-floating">Weight</label>
                </div>
            </div>
        </template>
        <template slot="buttons" slot-scope="slot_data">
            <button class="bluebutton"
                    v-show-loading-close
                    v-on:click="$root.$emit('item_editing_save',
                    {
                        id : slot_data.slotprops.item_editing_open.id,
                        label : slot_data.slotprops.item_editing_open.label,
                        weight : slot_data.slotprops.item_editing_open.weight,
                        bought : slot_data.slotprops.item_editing_open.bought,
                        expires : slot_data.slotprops.item_editing_open.expires,
                        category : slot_data.slotprops.item_editing_open.category,
                        freezer : slot_data.slotprops.item_editing_open.freezer,

                    });">Edit<span class="dot"></span>
                <span class="dot"></span>
                <span class="dot"></span>
                <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52"><circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/><path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/></svg></button>
        </template>
    </modal><!--/-->
    <modal custom-class="createItem">
        <template slot="title" slot-scope="slot_data">
            <h2>Create item</h2>
        </template>
        <template slot="content" slot-scope="slot_data">
            <div class="input-groups">
                <div class="group">
                    <input type="text" class="float-input-label" v-model="slot_data.slotprops.item_editing_open.label" placeholder=" "/>
                    <label class="label-floating">Item name</label>
                </div>
                <div class="group vue-date">
                    <v-date-picker v-model="slot_data.slotprops.item_editing_open.expires" :attributes="slot_data.slotprops.global.calendarAttrs"></v-date-picker>
                    <label class="label_under">Expires</label>
                </div>
                <div class="group vue-date">
                    <v-date-picker v-model="slot_data.slotprops.item_editing_open.bought" :attributes="slot_data.slotprops.global.calendarAttrs"></v-date-picker>
                    <label class="label_under">Bought</label>
                </div>
                <div class="group select">
                    <select name="category" v-model="slot_data.slotprops.item_editing_open.category" required>
                        <option v-for="cat in slot_data.slotprops.item_editing_open.cats[0]" v-bind:value="cat.id">@{{ cat.label }}</option>
                    </select>
                    <label class="label_under">Item category *</label>
                </div>
                <div class="group select">
                    <select name="category" v-model="slot_data.slotprops.item_editing_open.freezer" required>
                        <option v-for="freezer in slot_data.slotprops.item_editing_open.freezers[0]" v-bind:value="freezer.id">@{{ freezer.name }}</option>
                    </select>
                    <label class="label_under">Item freezer *</label>
                </div>
                <div class="group">
                    <input type="number" class="float-input-label" v-model="slot_data.slotprops.item_editing_open.weight" placeholder=" "/>
                    <label class="label-floating">Weight</label>
                </div>
            </div>
        </template>
        <template slot="buttons" slot-scope="slot_data">
            <button class="bluebutton"
                    v-show-loading-close
                    v-on:click="$root.$emit('item_creating',
                    {
                        label : slot_data.slotprops.item_editing_open.label,
                        weight : slot_data.slotprops.item_editing_open.weight,
                        bought : slot_data.slotprops.item_editing_open.bought,
                        expires : slot_data.slotprops.item_editing_open.expires,
                        category : slot_data.slotprops.item_editing_open.category,
                        freezer : slot_data.slotprops.item_editing_open.freezer,

                    });">Save<span class="dot"></span>
                <span class="dot"></span>
                <span class="dot"></span>
                <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52"><circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/><path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/></svg></button>
        </template>
    </modal>
@endsection