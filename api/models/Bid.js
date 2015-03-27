/**
 * Bid.js
 *
 * @description :: TODO: You might write a short summary of how this model works and what it represents here.
 * @docs        :: http://sailsjs.org/#!documentation/models
 */

module.exports = {

    attributes: {
        name: {
            type: 'string',
            required: true
        },
        type: {
            type: 'string',
            enum: ['FREE', 'STEP'],
            required: true
        },
        category: {
            type: 'string',
            enum: sails.config.globals.BID_CATEGORY,
            required: true
        },
        step: {
            type: 'integer'
        },
        startPrice: {
            type: 'float',
            required: true
        },
        expireHours: {
            type: 'integer',
            required: true
        },
        description: {
            type: 'string',
            required: true
        },
        screenshot: {
            type: 'array',
            required: true
        },
        video: {
            type: 'array'
        }
    }
};

