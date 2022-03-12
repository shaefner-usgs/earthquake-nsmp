'use strict';


// Static object with utility methods
var AppUtil = function () {};


/**
 * Add timeout support to a fetch() request.
 *
 * Taken from: https://dmitripavlutin.com/timeout-fetch-request/
 *
 * @param resource {String}
 *     URI
 * @param options {Object} optional; default is {}
 *     fetch() settings, with an additional prop for timeout in milliseconds
 */
AppUtil.fetchWithTimeout = async function (resource, options = {}) {
  const { timeout = 10000 } = options;

  const controller = new AbortController();
  const id = setTimeout(() => controller.abort(), timeout);

  const response = await fetch(resource, {
    ...options,
    signal: controller.signal
  });
  clearTimeout(id);

  return response;
};


module.exports = AppUtil;
