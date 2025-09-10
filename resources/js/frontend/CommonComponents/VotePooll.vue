<template>
  <div :class="['poll-wrapper', { vote: isVoteActive }]">
    <header>
      <div class="thumb">
        <img :src="'/' + poll?.data?.image || '/uploads/default.jpg'" alt="" />
      </div>
      <div class="content">
        <h6 class="voter-name">{{ poll?.data?.title }}</h6>
        <span>{{ poll?.data?.description }}</span>
      </div>
      <button class="poll-btn close-btn" @click="toggleVote">
        <i class="fas fa-times"></i>
      </button>
    </header>
    <!-- Debug info - remove in production -->
    <!-- <div
      v-if="poll"
      style="background: #f0f0f0; padding: 10px; margin: 10px; font-size: 12px"
    >
      <p><strong>Debug Info:</strong></p>
      <p>Poll ID: {{ poll?.data?.id }}</p>
      <p>Options Count: {{ poll?.data?.options?.length }}</p>
      <p>Selected Option: {{ selectedOption }}</p>
      <p>Has Voted: {{ hasVoted }}</p>
      <p>Session ID: {{ sessionId }}</p>
      <p>Poll Results: {{ JSON.stringify(pollResults) }}</p>
      <p>Total Votes: {{ totalVotes }}</p>
      <p>Computed Percentages: {{ JSON.stringify(optionPercentages) }}</p>
      <p>Options: {{ JSON.stringify(poll?.data?.options) }}</p>
    </div> -->
    <!-- Show message if no poll data -->
    <!-- <div
      v-else
      style="background: #ffebee; padding: 10px; margin: 10px; color: #c62828"
    >
      <p><strong>No Poll Data Available</strong></p>
    </div> -->

    <!-- Test click functionality -->
    <!-- <div style="background: #e8f5e8; padding: 10px; margin: 10px">
      <button @click="testClick" style="padding: 5px 10px; margin: 5px">
        Test Click
      </button>
      <span>Click count: {{ clickCount }}</span>
    </div> -->

    <div class="poll-area">
      <div
        v-for="(option, index) in poll?.data?.options"
        :key="option.id"
        :class="['opt-' + (index + 1), 'label']"
        @click="!hasVoted && selectOption(option.id)"
      >
        <div
          :class="[
            'content-wrap',
            { selected: selectedOption == option.id, disabled: hasVoted },
          ]"
        >
          <input
            type="radio"
            name="poll_option_id"
            :id="'opt-' + (index + 1)"
            :value="option.id"
            v-model="selectedOption"
            :disabled="hasVoted"
            style="display: none"
          />
          <div class="content">
            <span
              :class="['circle', { checked: selectedOption == option.id }]"
            ></span>
            <span class="text">{{ option.option_title }}</span>
          </div>
          <span class="percent" :class="{ 'd-block': hasVoted }"
            >{{ optionPercentages[option.id] || 0 }}%</span
          >
        </div>
        <!-- <div
          :class="['progress', 'style-' + String(index).padStart(2, '0')]"
          :style="{ '--w': optionWidths[option.id] || 5 }"
        ></div> -->
        <div
          class="progress"
          :class="{ 'd-block': hasVoted }"
          :style="{
            backgroundColor: 'var(--main-color-one)',
            height: '5px',
            borderRadius: '8px',
            width: optionWidths[option.id] + '%',
          }"
        ></div>
      </div>
    </div>
    <div class="btn-wrapper vote-btn">
      <button
        @click="submitVote"
        class="boxed-btn btn-sanatory"
        :disabled="!selectedOption || hasVoted || isSubmitting"
      >
        {{
          hasVoted
            ? "Already Voted"
            : isSubmitting
            ? "Submitting..."
            : "Vote Now"
        }}
        <i class="fas fa-vote-yea"></i>
      </button>
    </div>
  </div>
  <div class="btn-wrapper poll-btn">
    <span class="boxed-btn btn-poll" @click="toggleVote">
      Vote Now
      <i class="fas fa-vote-yea"></i>
    </span>
  </div>
</template>
<script>
import axios from "axios";

export default {
  props: {
    poll: Object,
  },
  name: "VotePooll",
  data() {
    return {
      isVoteActive: false,
      selectedOption: null,
      hasVoted: false,
      isSubmitting: false,
      pollResults: {},
      sessionId: null,
      clickCount: 0,
    };
  },
  created() {
    console.log("VotePooll created with poll:", this.poll);
    this.initializeSession();
    if (this.poll?.data?.id) {
      this.checkIfAlreadyVoted();
      this.loadPollResults();
    }
  },
  watch: {
    poll: {
      handler(newPoll) {
        console.log("Poll data changed:", newPoll);
        if (newPoll?.data?.id) {
          this.checkIfAlreadyVoted();
          this.loadPollResults();
        }
      },
      deep: true,
    },
  },
  methods: {
    toggleVote() {
      this.isVoteActive = !this.isVoteActive;
      console.log("Vote toggled:", this.isVoteActive);
    },

    // testClick() {
    //   this.clickCount++;
    //   console.log("Test click works! Count:", this.clickCount);
    // },

    selectOption(optionId) {
      console.log(
        "selectOption called with:",
        optionId,
        "hasVoted:",
        this.hasVoted
      );
      if (!this.hasVoted) {
        this.selectedOption = optionId;
        console.log("Option selected:", optionId);
        // Force reactivity update
        this.$nextTick(() => {
          console.log(
            "After nextTick, selectedOption is:",
            this.selectedOption
          );
        });
      } else {
        console.log("Cannot select option - already voted");
      }
    },

    onOptionChange() {
      console.log("Option changed to:", this.selectedOption);
    },

    initializeSession() {
      // Get or create session ID
      this.sessionId = localStorage.getItem("poll_session_id");
      if (!this.sessionId) {
        this.sessionId =
          Date.now() + "_" + Math.random().toString(36).substr(2, 9);
        const expirationTime = Date.now() + 24 * 60 * 60 * 1000; // 1 day in milliseconds
        const sessionData = {
          sessionId: this.sessionId,
          expiresAt: expirationTime,
        };
        localStorage.setItem("poll_session_id", JSON.stringify(sessionData));
      }
    },

    async checkIfAlreadyVoted() {
      if (!this.poll?.data?.id) {
        console.log("No poll ID available for vote check");
        return;
      }

      try {
        console.log(
          "Checking vote status for poll:",
          this.poll.data.id,
          "session:",
          this.sessionId
        );
        const response = await axios.get(
          `/polls/${this.poll.data.id}/check-vote`,
          {
            params: { session_id: this.sessionId },
          }
        );
        console.log("Vote check response:", response.data);
        this.hasVoted = response.data.has_voted;
        console.log("Has voted status:", this.hasVoted);
      } catch (error) {
        console.error("Error checking vote status:", error);
        if (error.response) {
          console.error("Response data:", error.response.data);
          console.error("Response status:", error.response.status);
        }
      }
    },

    async loadPollResults() {
      if (!this.poll?.data?.id) {
        console.log("No poll ID available for results");
        return;
      }

      try {
        console.log("Loading poll results for:", this.poll.data.id);
        const response = await axios.get(`/polls/${this.poll.data.id}/results`);
        console.log("Poll results response:", response.data);
        this.pollResults = response.data.results || {};
      } catch (error) {
        console.error("Error loading poll results:", error);
        if (error.response) {
          console.error("Response data:", error.response.data);
          console.error("Response status:", error.response.status);
        }
      }
    },

    async submitVote() {
      if (!this.selectedOption || this.hasVoted || this.isSubmitting) {
        console.log("Vote submission blocked:", {
          selectedOption: this.selectedOption,
          hasVoted: this.hasVoted,
          isSubmitting: this.isSubmitting,
        });
        return;
      }

      this.isSubmitting = true;
      console.log("Submitting vote:", {
        pollId: this.poll.data.id,
        optionId: this.selectedOption,
        sessionId: this.sessionId,
      });

      try {
        const response = await axios.post(`/polls/${this.poll.data.id}/vote`, {
          poll_option_id: this.selectedOption,
          session_id: this.sessionId,
        });

        console.log("Vote submission response:", response.data);

        if (response.data.success) {
          this.hasVoted = true;
          await this.loadPollResults(); // Reload results after voting
          this.$emit("voted", response.data);
          console.log("Vote submitted successfully");
        } else {
          console.error("Vote submission failed:", response.data);
        }
      } catch (error) {
        console.error("Error submitting vote:", error);
        if (error.response) {
          console.error("Response data:", error.response.data);
          console.error("Response status:", error.response.status);
        }
      } finally {
        this.isSubmitting = false;
      }
    },

    getOptionPercentage(optionId) {
      // This method is deprecated - use computed property optionPercentages instead
      return this.optionPercentages[optionId] || 0;
    },

    getOptionWidth(optionId) {
      // This method is deprecated - use computed property optionWidths instead
      return this.optionWidths[optionId] || 5;
    },
  },
  computed: {
    totalVotes() {
      return Object.values(this.pollResults).reduce(
        (sum, count) => sum + count,
        0
      );
    },

    optionPercentages() {
      const percentages = {};
      const total = this.totalVotes;

      if (total === 0) {
        // Return 0% for all options if no votes
        this.poll?.data?.options?.forEach((option) => {
          percentages[option.id] = 0;
        });
        return percentages;
      }

      this.poll?.data?.options?.forEach((option) => {
        const optionKey = String(option.id);
        const optionVotes = this.pollResults[optionKey] || 0;
        percentages[option.id] = Math.round((optionVotes / total) * 100);
      });

      console.log("Computed percentages:", percentages);
      return percentages;
    },

    optionWidths() {
      const widths = {};
      Object.keys(this.optionPercentages).forEach((optionId) => {
        const percentage = this.optionPercentages[optionId];
        widths[optionId] = Math.max(percentage, 5); // Minimum width for visibility
      });
      return widths;
    },
  },
};
</script>

<style scoped>
/* .custom_thumb_style {
  width: 100px;
  height: 100px;
  margin-right: 10px;
} */
/* .custom_thumb_style .image_common {
  width: 100%;
  height: 100%;
  object-fit: cover;
  object-position: center;
} */
.poll-area input[type="radio"] {
  display: none;
}

.poll-area .label {
  cursor: pointer;
  position: relative;
  margin-bottom: 15px;
  border: 2px solid transparent;
  border-radius: 5px;
  transition: all 0.3s ease;
}

.poll-area .label:hover {
  border-color: #007bff;
  background-color: #f8f9fa;
}

.poll-area .content-wrap {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 10px;
  background: #f8f9fa;
  border-radius: 5px;
  transition: all 0.3s ease;
}

.poll-area .content {
  display: flex;
  align-items: center;
  gap: 10px;
}

.poll-area .circle {
  width: 20px;
  height: 20px;
  border: 2px solid #ddd;
  border-radius: 50%;
  position: relative;
  transition: all 0.3s ease;
}

.poll-area .circle.checked {
  border-color: #007bff;
  background-color: #007bff;
}

.poll-area .circle.checked::after {
  content: "";
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 8px;
  height: 8px;
  background: white;
  border-radius: 50%;
}

.poll-area .content-wrap.selected {
  background: #e3f2fd;
  border-left: 4px solid #007bff;
}

.poll-area .content-wrap.selected .content {
  color: #007bff;
}

.poll-area .content-wrap.disabled {
  opacity: 0.7;
  cursor: not-allowed;
}

.poll-area .progress {
  height: 8px;
  background: #e9ecef;
  border-radius: 4px;
  overflow: hidden;
  margin-top: 5px;
  position: relative;
}

.poll-area .progress::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  height: 100%;
  width: calc(var(--w) * 1%);
  background: linear-gradient(90deg, #007bff, #0056b3);
  border-radius: 4px;
  transition: width 0.5s ease;
}

.poll-area .progress.style-01::before {
  background: linear-gradient(90deg, #28a745, #1e7e34);
}

.poll-area .progress.style-02::before {
  background: linear-gradient(90deg, #ffc107, #e0a800);
}

.poll-area .progress.style-03::before {
  background: linear-gradient(90deg, #dc3545, #bd2130);
}

.btn-sanatory:disabled {
  opacity: 0.6;
  cursor: not-allowed;
}

.poll-wrapper.vote .poll-area {
  animation: slideIn 0.3s ease;
}

@keyframes slideIn {
  from {
    opacity: 0;
    transform: translateY(-10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}
</style>
